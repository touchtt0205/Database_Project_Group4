<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggleFavorite($productId)
    {
        $user = Auth::user();
        $favorite = Favorite::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'ลบออกจากรายการโปรดเรียบร้อย!');
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            return back()->with('success', 'เพิ่มเข้าสู่รายการโปรดเรียบร้อย!');
        }
    }

    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->with('product')->get();
        return view('favorites.index', compact('favorites'));
    }
}
