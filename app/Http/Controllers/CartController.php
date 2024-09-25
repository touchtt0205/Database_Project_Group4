<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller

{
    public function add(Request $request, $imageId)
    {
        $image = Image::findOrFail($imageId);

        if ($image->user_id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot add your own image to the cart.');
        }

        Cart::create([
            'user_id' => Auth::id(),
            'image_id' => $image->id,
        ]);

        return redirect()->route('cart.show')->with('success', 'Image added to cart.');
    }

    public function show()
    {
        $carts = Cart::where('user_id', Auth::id())->with('image')->get();
        return view('cart.show', compact('carts'));
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart.show')->with('success', 'Image removed from cart.');
    }
}
