<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\PhotoTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Favorite;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\ImageOwnership;
use App\Models\Tag;



class ImageController extends Controller
{

    public function filterByTag($tagName)
    {
        // Fetch images that have the specified tag name
        $images = Image::whereHas('tags.tag', function ($query) use ($tagName) {
            $query->where('name', $tagName); // Reference the 'name' column in the 'tags' table
        })->with('tags.tag')->get();

        // Check if images are found
        $message = $images->isEmpty() ? "No images available for this tag." : null;

        // Return the view with filtered images and message
        return view('images.index', compact('images', 'message'));
    }

    public function index(Request $request)
    {
        $query = Image::query();

        // Check if there's a sort parameter
        if ($request->has('sort')) {
            $sort = $request->get('sort');

            if ($sort === 'latest') {
                $query->orderBy('created_at', 'desc'); // Sort by latest
            } elseif ($sort === 'oldest') {
                $query->orderBy('created_at', 'asc'); // Sort by oldest
            } elseif ($sort === 'price_asc') {
                $query->orderBy('price', 'asc'); // Sort price low to high
            } elseif ($sort === 'price_desc') {
                $query->orderBy('price', 'desc'); // Sort price high to low
            }
        } else {
            $query->orderBy('created_at', 'desc'); // Default sort by latest
        }

        // ดึงข้อมูลรูปภาพตาม Tag ถ้ามีการกรอง
        $tagName = $request->input('tag');

        // Fetch images based on the tag if exists
        if ($tagName) {
            $images = $query->whereHas('tags', function ($query) use ($tagName) {
                $query->where('name', $tagName);
            })->get(); // Fetch images with the specified tag
        } else {
            $images = $query->get(); // Fetch all images
        }

        // Fetch all tags
        $tags = Tag::all();
        if ($request->has('tag')) {
            $images->whereHas('tags', function ($query) use ($request) {
                $query->where('name', $request->input('tag'));
            });
            $selectedTag = $request->input('tag'); // รับค่าแท็กที่เลือก
        } else {
            $selectedTag = null; // ไม่มีการเลือกแท็ก
        }

        return view('images.index', compact('images', 'tags'));
    }


    public function create()
    {
        return view('images.create');
    }

    public function store(Request $request)
    {
        // ตรวจสอบเงื่อนไขการตรวจสอบฟอร์มทั่วไป
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // ถ้ารูปภาพไม่ฟรี ต้องตรวจสอบฟิลด์ราคาและ max_sales
        if (!$request->has('free')) {
            $request->validate([
                'price' => 'required|integer|min:0',
                'max_sales' => 'nullable|integer|min:1', // max_sales ไม่จำเป็นต้องกรอก
            ]);
        }

        // จัดเก็บไฟล์รูปภาพ
        $path = $request->file('image')->store('images', 'public');

        // สร้างบันทึกในฐานข้อมูลและเก็บไว้ในตัวแปร $image
        $image = Image::create([
            'path' => $path,
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->has('free') ? 0 : $request->price,
            'max_sales' => $request->has('free') || !$request->filled('max_sales') ? null : $request->max_sales,
        ]);

        // ตรวจสอบและบันทึกแท็ก
        if ($request->has('tags')) {
            foreach ($request->tags as $tagId) {
                PhotoTag::create([
                    'photo_id' => $image->id,  // ใช้ตัวแปร $image ที่ได้จากการสร้างบันทึก
                    'tags_id' => $tagId,
                ]);
            }
        }

        return redirect()->route('images.index')->with('success', 'Image uploaded successfully.');
    }


    public function destroy($id)
    {
        // ค้นหารูปภาพตาม ID
        $image = Image::findOrFail($id);

        // ตรวจสอบว่าผู้ใช้เป็นเจ้าของรูปหรือไม่
        if (Auth::id() !== $image->user_id) {
            return redirect()->route('images.index')->with('error', 'You are not authorized to delete this image.');
        }

        // ตรวจสอบว่าไฟล์มีอยู่จริงหรือไม่
        $filePath = storage_path('app/public/' . $image->path);
        if (file_exists($filePath)) {
            // ลบไฟล์จาก storage
            Storage::delete('public/' . $image->path);
        }

        // ลบข้อมูลรูปจากฐานข้อมูล
        $image->delete();

        return redirect()->route('profile.show', ['id' => Auth::id()]);
    }





    public function show($id)
    {
        $image = Image::with(['user', 'tags.tag'])->findOrFail($id); // Load tags with related tags

        // ตรวจสอบว่าผู้ใช้ซื้อภาพนี้แล้วหรือยัง
        $hasPurchased = false;
        if (Auth::check()) {
            $userId = Auth::id();
            // ตรวจสอบในตาราง image_ownerships ว่าผู้ใช้มีการซื้อภาพนี้แล้วหรือไม่
            $hasPurchased = ImageOwnership::where('user_id', $userId)
                ->where('image_id', $id)
                ->exists();
        }

        // ส่งข้อมูลไปที่ view พร้อมกับตัวแปร hasPurchased
        return view('images.show', compact('image', 'hasPurchased'));
    }



    // public function download($id)
    // {
    //     // ค้นหารูปภาพตาม ID
    //     $image = Image::findOrFail($id);

    //     // ตรวจสอบว่าผู้ใช้สามารถดาวน์โหลดได้หรือไม่
    //     if ($image->price > 0) {
    //         return redirect()->route('images.show', $id)->with('error', 'This image is not free to download.');
    //     }

    //     // กำหนดเส้นทางไฟล์ต้นฉบับ
    //     $filePath = storage_path('app/public/' . $image->path);

    //     // ตรวจสอบว่าไฟล์มีอยู่จริง
    //     if (!file_exists($filePath)) {
    //         return redirect()->route('images.show', $id)->with('error', 'File not found.');
    //     }

    //     // สร้างชื่อไฟล์ใหม่จาก title
    //     $fileName = $image->title . '.' . pathinfo($filePath, PATHINFO_EXTENSION); // ใช้ชื่อ title ของภาพและเพิ่มนามสกุล

    //     // ส่งไฟล์ให้ผู้ใช้ดาวน์โหลด
    //     return response()->download($filePath, $fileName);
    // }


    public function addToAlbum(Request $request, $imageId)
    {
        // ค้นหารูปภาพตาม ID
        $image = Image::findOrFail($imageId);

        // ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to add images to an album.');
        }

        // ตรวจสอบว่าอัลบั้มมีอยู่หรือไม่
        $album = Auth::user()->albums()->find($request->album_id);
        if (!$album) {
            return redirect()->back()->with('error', 'Album not found.');
        }

        // ตรวจสอบว่ารูปภาพนี้ถูกเพิ่มในอัลบั้มนี้แล้วหรือไม่
        if ($album->images()->where('image_id', $image->id)->exists()) {
            return redirect()->back()->with('error', 'Image is already in this album.');
        }

        // เพิ่มรูปภาพลงในอัลบั้ม
        $album->images()->attach($imageId);

        return redirect()->back()->with('success', 'Image added to album successfully.');
    }


    public function download($id)
    {
        // ค้นหารูปภาพตาม ID
        $image = Image::findOrFail($id);

        // ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to download images.');
        }

        $user = Auth::user();

        // ตรวจสอบว่าผู้ใช้ได้ซื้อภาพนี้ไปแล้วหรือไม่
        $ownershipExists = ImageOwnership::where('user_id', $user->id)
            ->where('image_id', $image->id)
            ->exists();

        if (!$ownershipExists && $image->price > 0) {
            return redirect()->route('images.show', $id)->with('error', 'You have not purchased this image.');
        }

        // กำหนดเส้นทางไฟล์ต้นฉบับ
        $filePath = storage_path('app/public/' . $image->path);

        // ตรวจสอบว่าไฟล์มีอยู่จริง
        if (!file_exists($filePath)) {
            return redirect()->route('images.show', $id)->with('error', 'File not found.');
        }

        // สร้างชื่อไฟล์ใหม่จาก title
        $fileName = $image->title . '.' . pathinfo($filePath, PATHINFO_EXTENSION);

        // ส่งไฟล์ให้ผู้ใช้ดาวน์โหลด
        return response()->download($filePath, $fileName);
    }


    public function buy($id)
    {
        // ค้นหารูปภาพตาม ID
        $image = Image::findOrFail($id);

        // ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to purchase images.');
        }

        // ค้นหาผู้ใช้ที่เข้าสู่ระบบ
        $user = Auth::user();

        // ตรวจสอบว่าเงินของผู้ใช้เพียงพอหรือไม่
        if ($user->coins < $image->price) {
            return redirect()->route('images.show', $id)->with('error', 'Insufficient balance to purchase this image.');
        }

        // ตรวจสอบว่าผู้ใช้ได้ซื้อภาพนี้ไปแล้วหรือไม่
        $ownershipExists = ImageOwnership::where('user_id', $user->id)
            ->where('image_id', $image->id)
            ->exists();

        if ($ownershipExists) {
            return redirect()->route('images.show', $id)->with('error', 'You already own this image.');
        }

        // ตรวจสอบ max_sales หากเป็น 0 ก็ไม่สามารถซื้อได้
        if ($image->max_sales !== null && $image->max_sales <= 0) {
            return redirect()->route('images.show', $id)->with('error', 'This image is no longer available for purchase.');
        }

        // หักเงินจากผู้ใช้
        $user->coins -= $image->price;
        $user->save(); // บันทึกการเปลี่ยนแปลง

        // บันทึกการซื้อในตาราง orders
        $order = new Order();
        $order->user_id = $user->id;
        $order->price = $image->price;
        $order->quantity = 1;
        $order->status = 'completed';
        $order->created_at = now();
        $order->save();

        // เพิ่มเงินที่ได้จากการขายให้กับผู้ขาย
        $image->user->coins += $image->price;
        $image->user->save();

        // Log the order history
        $orderHistory = new OrderHistory();
        $orderHistory->user_id = $user->id;
        $orderHistory->order_id = $order->id;
        $orderHistory->price = $image->price;
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

        // ลดค่า max_sales ลง 1
        if ($image->max_sales !== null && $image->max_sales > 0) {
            $image->max_sales -= 1;
            $image->save(); // บันทึกการเปลี่ยนแปลง
        }

        return redirect()->route('images.show', $id)->with('success', 'Image purchased successfully!');
    }
}