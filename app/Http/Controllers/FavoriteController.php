<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store($imageId)
    {
        $favorite = Favorite::create([
            'user_id' => Auth::id(),
            'image_id' => $imageId,
        ]);

        return redirect()->back()->with('success', 'Image added to favorites!');
    }



    public function destroy($imageId)
    {
        // ตรวจสอบว่าผู้ใช้ล็อกอินอยู่
        if (Auth::check()) {
            Favorite::where('user_id', Auth::id())->where('image_id', $imageId)->delete();
            return redirect()->route('images.index')->with('success', 'Image removed from favorites.');
        }

        return redirect()->route('login')->with('error', 'You must be logged in to unfavorite an image.');
    }

    public function index()
    {
        $favorites = Favorite::with('image')->where('user_id', Auth::id())->get();

        return view('favorites.index', compact('favorites'));
    }
}
