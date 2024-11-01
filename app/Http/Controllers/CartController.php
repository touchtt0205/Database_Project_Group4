<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\ImageOwnership;



class CartController extends Controller

{

    public function add(Request $request, $imageId)
    {
        // ค้นหารูปภาพตาม ID
        $image = Image::findOrFail($imageId);

        // ตรวจสอบว่าผู้ใช้พยายามเพิ่มรูปภาพของตัวเองหรือไม่
        if ($image->user_id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot add your own image to the cart.');
        }

        // ตรวจสอบว่าผู้ใช้ได้ซื้อภาพนี้ไปแล้วหรือไม่
        $ownershipExists = ImageOwnership::where('user_id', Auth::id())
            ->where('image_id', $image->id)
            ->exists();

        if ($ownershipExists) {
            return redirect()->back()->with('error', 'You already own this image and cannot add it to the cart.');
        }

        // ตรวจสอบว่าผู้ใช้มีภาพนี้ในตะกร้าหรือไม่
        $cartExists = Cart::where('user_id', Auth::id())
            ->where('image_id', $image->id)
            ->exists();

        if ($cartExists) {
            return redirect()->back()->with('error', 'This image is already in your cart.');
        }

        // เพิ่มภาพในตะกร้า
        Cart::create([
            'user_id' => Auth::id(),
            'image_id' => $image->id,
        ]);

        return redirect()->route('images.index')->with('success', 'Image added to cart.');
        // return response()->json(['status' => 'success', 'message' => 'Image added to cart.']);
    }


    public function show()
    {
        $carts = Cart::where('user_id', Auth::id())->with('image')->get();
        $totalPrice = $carts->sum(function ($cart) {
            return $cart->image->price; // Assuming the 'price' attribute exists in the Image model
        });
        return view('cart.show', compact('carts'));
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart.show')->with('success', 'Image removed from cart.');
    }

    public function checkout()
    {
        // ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to proceed to checkout.');
        }

        // ค้นหาผู้ใช้ที่เข้าสู่ระบบ
        $user = Auth::user();

        // ค้นหาสินค้าในตะกร้าของผู้ใช้
        $carts = Cart::where('user_id', $user->id)->get();

        // ตรวจสอบว่าสินค้าในตะกร้าว่างหรือไม่
        if ($carts->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        // กำหนดระดับสมาชิกและส่วนลด
        $memberLevel = $user->member_level ?? null;
        $discountRate = 0;

        if ($memberLevel === "Bronze") {
            $discountRate = 0.05;
        } elseif ($memberLevel === "Silver") {
            $discountRate = 0.14;
        } elseif ($memberLevel === "Gold") {
            $discountRate = 0.20;
        } elseif ($memberLevel === "Platinum") {
            $discountRate = 0.30;
        } elseif ($memberLevel === "Diamond") {
            $discountRate = 0.40;
        } elseif ($memberLevel === "Ultimate") {
            $discountRate = 0.55;
        }

        $totalPrice = 0;
        $discountedTotalPrice = 0;

        // ตรวจสอบราคาสินค้าทั้งหมดและยอดเงินของผู้ใช้
        foreach ($carts as $cart) {
            $image = $cart->image;

            // ตรวจสอบว่าภาพนี้หมดจำนวนขายหรือไม่
            if ($image->max_sales !== null && $image->max_sales <= 0) {
                return redirect()->route('cart.show')->with('error', 'The image "' . $image->title . '" is no longer available.');
            }

            // รวมราคาของแต่ละภาพ
            $totalPrice += $image->price;
        }

        // คำนวณราคาหลังหักส่วนลด (ถ้ามี)
        $discountedTotalPrice = $totalPrice - ($totalPrice * $discountRate);

        // ตรวจสอบยอดเงินของผู้ใช้เพียงพอหรือไม่
        if ($user->coins < $discountedTotalPrice) {  // ใช้ราคาแบบลดแล้ว
            return redirect()->route('cart.show')->with('error', 'Insufficient balance to complete the purchase.');
        }

        // หักเงินจากผู้ใช้ (ตามราคาหลังหักส่วนลด)
        $user->coins -= $discountedTotalPrice;
        $user->save();

        // สร้าง order สำหรับการซื้อสินค้าแต่ละชิ้น
        foreach ($carts as $cart) {
            $image = $cart->image;

            // ตรวจสอบว่าผู้ใช้ได้ซื้อภาพนี้ไปแล้วหรือไม่
            $ownershipExists = ImageOwnership::where('user_id', $user->id)
                ->where('image_id', $image->id)
                ->exists();

            if ($ownershipExists) {
                return redirect()->route('cart.show')->with('error', 'You already own the image "' . $image->title . '".');
            }

            // สร้าง order ใหม่
            $order = new Order();
            $order->user_id = $user->id;
            $order->price = $image->price; // ราคาของภาพแต่ละชิ้น (สามารถเพิ่มข้อมูลส่วนลดได้ถ้าจำเป็น)
            $order->quantity = 1;
            $order->status = 'completed';
            $order->created_at = now();
            $order->save();

            // บันทึกการซื้อใน order history
            $orderHistory = new OrderHistory();
            $orderHistory->user_id = $user->id;
            $orderHistory->order_id = $order->id;
            $orderHistory->price = $image->price; // บันทึกราคาของภาพ
            $orderHistory->status = 'completed';
            $orderHistory->created_at = now();
            $orderHistory->save();

            // บันทึกการเป็นเจ้าของรูป
            ImageOwnership::create([
                'user_id' => $user->id,
                'image_id' => $image->id,
                'path' => $image->path,
                'purchased_at' => now(),
            ]);

            // เพิ่มเงินที่ได้จากการขายให้กับผู้ขาย
            $image->user->coins += $image->price;  // ผู้ขายจะได้รับราคาปกติ
            $image->user->save();

            // ลดค่า max_sales ลง 1 ถ้ามี
            if ($image->max_sales !== null && $image->max_sales > 0) {
                $image->max_sales -= 1;
                $image->save();
            }

            // ลบสินค้านี้ออกจากตะกร้า
            $cart->delete();
        }

        return redirect()->route('cart.show')->with('success', 'Checkout completed successfully! All items have been purchased.');
    }
}
