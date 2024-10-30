<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search images by title
        $images = Image::where('title', 'LIKE', "%{$query}%")
            ->take(5)
            ->get()
            ->map(function ($image) {
                return [
                    'type' => 'image',
                    'id' => $image->id,
                    'title' => $image->title,
                ];
            });

        // Search users by name
        $users = User::where('name', 'LIKE', "%{$query}%")
            ->where('email', 'NOT LIKE', '%@admin.com') // Exclude admin users
            ->take(5)
            ->get()
            ->map(function ($user) {
                return [
                    'type' => 'user',
                    'id' => $user->id,
                    'name' => $user->name,
                ];
            });


        // Combine the results
        $results = collect();
        $results = $results->concat($images)->concat($users);
        return response()->json($results);
    }
}
