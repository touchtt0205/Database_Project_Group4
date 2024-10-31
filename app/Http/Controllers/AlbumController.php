<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Image;
use App\Models\User;

class AlbumController extends Controller
{

    use AuthorizesRequests;
    public function index()
    {
        $user = Auth::user();
        $albums = Album::where('user_id', $user->id)->with('images')->get(); // ดึงอัลบั้มพร้อมกับรูปภาพ
        $images = Image::where('user_id', $user->id)->get(); // ดึงรูปภาพทั้งหมดของผู้ใช้ (ถ้ามี)
        return view('profile', compact('user', 'albums', 'images')); // ส่งข้อมูลไปยัง view profile
    }




    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        Album::create([
            'title' => $request->title,
            'user_id' => auth()->id(),
            'description' => $request->description,
        ]);

        return redirect()->route('profile.show', ['id' => Auth::id()]); // Redirect to the profile of the logged-in user
    }

    public function destroy($id)
    {
        // Find the album by ID
        $album = Album::findOrFail($id);

        // Check if the authenticated user is the owner of the album
        if ($album->user_id !== Auth::id()) {
            return redirect()->route('albums.index')->with('error', 'Unauthorized action.');
        }

        // Delete the album
        $album->delete();

        // Redirect to the albums index or another page
        return redirect()->route('profile.show', ['id' => Auth::id()]);
    }

    public function show(Album $album)
    {
        // Ensure the album is correctly resolved
        // This should be fine if the policy is working
        $images = $album->images; // Get the images associated with the album
        return view('albums.show', compact('album', 'images')); // Pass the album and images to the view
    }



    public function showProfile($userId)
    {
        $user = User::findOrFail($userId); // Get user by ID
        $albums = Album::where('user_id', $user->id)->with('images')->get(); // Get albums for the user
        $images = Image::where('user_id', $user->id)->get(); // Get images for the user

        return view('profile', compact('user', 'albums', 'images')); // Pass variables to the view
    }
}
