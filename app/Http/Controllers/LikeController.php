<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Image $image)
    {
        $like = Like::firstOrCreate([
            'photo_id' => $image->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }

    public function unlike(Image $image)
    {
        $like = Like::where('photo_id', $image->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($like) {
            $like->delete();
        }

        return redirect()->back();
    }
}