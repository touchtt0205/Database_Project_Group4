<?php

namespace App\Http\Controllers;

use App\Models\ImageOwnership;
use Illuminate\Support\Facades\Auth;

class PurchasedImagesController extends Controller
{
    public function index()
    {
        // Fetch the images owned by the logged-in user
        $purchasedImages = ImageOwnership::where('user_id', Auth::id())
            ->with('image')  // Load the associated image data
            ->get();

        return view('purchased_images.index', compact('purchasedImages'));
    }
}
