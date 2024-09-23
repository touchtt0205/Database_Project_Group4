<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('carts.index', compact('carts'));
    }

    public function store(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // ค้นหาสินค้าในตะกร้าที่มีอยู่แล้ว
        $cart = Cart::where('user_id', Auth::id())->where('product_id', $productId)->first();

        if ($cart) {
            // ถ้ามีสินค้าในตะกร้าอยู่แล้ว เพิ่มจำนวน
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            // ถ้าไม่มีสินค้าในตะกร้า ให้สร้างรายการใหม่
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('carts.index')->with('success', 'เพิ่มสินค้าลงในตะกร้าสำเร็จ!');
    }


    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('carts.index')->with('success', 'ลบสินค้าจากตะกร้าสำเร็จ!');
    }

    public function checkout(Request $request)
    {
        // สามารถใช้ $request->input('selected_products') เพื่อเข้าถึงสินค้า
        $selectedProducts = $request->input('selected_products', []);

        // ดำเนินการกับการชำระเงินที่นี่...

        return redirect()->route('carts.index')->with('success', 'การชำระเงินเสร็จสิ้น!');
    }

    public function calculate(Request $request)
    {
        $selectedItems = $request->input('selected_items', []);
        $total = 0;

        foreach ($selectedItems as $cartId) {
            $cart = Cart::findOrFail($cartId);
            $total += $cart->product->price * $cart->quantity;
        }

        return redirect()->route('carts.index')->with('success', 'ราคารวมของสินค้าที่เลือก: ' . number_format($total, 2) . ' บาท');
    }

    public function update(Request $request, $cartId)
    {
        $cart = Cart::findOrFail($cartId);

        if ($request->action == 'increase') {
            $cart->increment('quantity');
        } elseif ($request->action == 'decrease') {
            if ($cart->quantity >= 1) {
                $cart->decrement('quantity');
            } else {
                return redirect()->route('carts.index')->with('error', 'ไม่สามารถลดจำนวนสินค้าลงได้!');
            }
        }

        return redirect()->route('carts.index')->with('success', 'จำนวนสินค้าถูกอัปเดตเรียบร้อย!');
    }
}
