<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
class TagController extends Controller
{
    public function index()
    {
    
        if (!Auth::user()->isAdmin) {
            return redirect('/dashboard'); // redirect หากไม่ใช่ admin
        }
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags')); // Adjust view as necessaryct('slips'));
    }

    // Add this method to your TagController
public function showUploadForm()
{
    // Fetch all tags from the database
    $tags = Tag::all();

    // Return the upload image view and pass the tags
    return view('images.create', compact('tags')); // Replace 'your-upload-view-name' with the actual view name for the upload form
}


  

    // Method to store a new tag
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Tag::create($request->only('name'));

        return redirect()->route('admin.tags.index')->with('success', 'Tag added successfully.');
    }

    // Method to delete a tag
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('success', 'Tag deleted successfully.');
    }
}