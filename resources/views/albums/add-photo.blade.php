@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Add Photo to Album</h1>

    <form action="{{ route('album-images.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="album" class="block text-sm font-medium text-gray-700">Select Album:</label>
            <select name="album_id" id="album"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                <option value="" disabled selected>Select an album</option>
                @foreach($albums as $album)
                <option value="{{ $album->id }}">{{ $album->title }}</option>
                @endforeach
            </select>
            @error('album_id')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Upload Image:</label>
            <input type="file" name="image_id" id="image" class="mt-1 block w-full">
            @error('image_id')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add Photo</button>
    </form>
</div>
@endsection