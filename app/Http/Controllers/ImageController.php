<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Favorite;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('images.index', compact('images'));
    }

    public function create()
    {
        return view('images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'max_sales' => 'required|integer',
        ]);

        $path = $request->file('image')->store('images', 'public');

        // สร้างบันทึกในฐานข้อมูล
        Image::create([
            'path' => $path,
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'max_sales' => $request->max_sales,
        ]);

        return redirect()->route('images.index')->with('success', 'Image uploaded successfully.'); // เปลี่ยนเส้นทางหลังจากอัปโหลดเสร็จ
    }

    public function show($id)
    {
        $image = Image::with('user')->findOrFail($id);

        return view('images.show', compact('image'));
    }
}
