<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    //
    public function show(Product $product)
    {
        $user = $product->user; // ดึงผู้ใช้ที่เพิ่มสินค้า

        return view('products.show', compact('product', 'user'));
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
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        // $product->user_id = $request->quantity;
        $product->user_id = Auth::id(); // ดึง user_id จาก authenticated user


        if ($request->hasFile('image')) {
            $product->image_path = $request->file('image')->store('images', 'public');
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

    public function myProducts($userId)
    {
        $products = Product::where('user_id', $userId)->get();
        return view('products.my', compact('products'));
    }

    public function showUserProducts($userId)
    {
        $user = User::findOrFail($userId);
        $products = $user->products; // สินค้าที่ผู้ใช้คนนั้นเพิ่ม

        return view('products.user-products', compact('user', 'products'));
    }
}
