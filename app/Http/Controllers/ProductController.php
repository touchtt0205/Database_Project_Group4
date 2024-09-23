<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }



    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // validation สำหรับรูปภาพ
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        // อัปโหลดรูปภาพ
        if ($request->hasFile('image')) {
            $product->image_path = $request->file('image')->store('images', 'public'); // อัปโหลดไฟล์ไปยังโฟลเดอร์ public/images
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'เพิ่มสินค้าสำเร็จ!');
    }

    public function destroy(Product $product)
    {
        // ลบไฟล์ภาพถ้ามี
        if ($product->image_path) {
            Storage::delete('public/' . $product->image_path);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
