<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Image Gallery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Welcome to the Image Gallery</h3>

                    @if($images->isEmpty())
                    <p>No images available at the moment.</p>
                    @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($images as $image)
                        <div class="max-w-sm rounded overflow-hidden shadow-lg">
                            <a href="{{ route('images.show', $image->id) }}">
                                <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $image->path) }}"
                                    alt="{{ $image->title }}">
                                <div class="px-6 py-4">
                                    <div class="font-bold text-xl mb-2">{{ $image->title }}</div>
                                    <p class="text-gray-700 text-base">
                                        {{ Str::limit($image->description, 100) }}
                                    </p>
                                    <p class="text-gray-700 text-base">
                                        <strong>Price:</strong> ${{ number_format($image->price, 2) }}
                                    </p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>