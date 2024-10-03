<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $imageId)
    {
        $request->validate([
            'content' => 'required|max:255',
        ]);

        $image = Image::findOrFail($imageId);

        // บันทึกความคิดเห็นใหม่
        $image->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function destroy($comment_id)
{
    $comment = Comments::findOrFail($comment_id);

    // Check if the authenticated user is the owner of the comment
    if ($comment->user_id !== Auth::id()) {
        return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
    }

    $comment->delete();

    return redirect()->back()->with('success', 'Comment deleted successfully!');
}

}