<!-- resources/views/albums/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $album->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">
                        Description:
                        @if(!empty($album->description))
                        {{ $album->description }}
                        @else
                        {{ __('No description ') }}
                        @endif
                    </h3>
                    @if($images->isEmpty())
                    <p>{{ __('No images found in this album.') }}</p>
                    @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($images as $image)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->title }}"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h4 class="font-semibold text-md mb-2">{{ $image->title }}</h4>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>