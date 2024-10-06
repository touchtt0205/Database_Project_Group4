<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200  leading-tight">
            {{ __('Image Store') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg">Available Images</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
                        @foreach ($images as $image)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->title }}"
                                class="w-full h-auto object-cover mb-2"> <!-- ปรับให้เต็ม card -->
                            <div class="p-4">
                                <!-- แยกเนื้อหาออกจากภาพ -->
                                <h4 class="font-semibold text-md">{{ $image->title }}</h4>
                                <p class="text-gray-500">Price: ${{ $image->price }}</p>
                                <div class="mt-2 flex justify-between items-center">
                                    <!-- Eye Icon for View Details -->
                                    <a href="{{ route('images.show', $image->id) }}"
                                        class="text-gray-500 hover:text-blue-500" title="View Details">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.5C6.75 4.5 3 12 3 12s3.75 7.5 9 7.5 9-7.5 9-7.5-3.75-7.5-9-7.5zM12 8.25a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5z" />
                                        </svg>
                                    </a>

                                    <div class="flex items-center">
                                        @if(Auth::user()->favorites()->where('image_id', $image->id)->exists())
                                        <form action="{{ route('favorites.destroy', $image->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 15.273l-4.79 2.52 1.027-5.977L1 6.691l5.978-.868L10 1l2.022 4.823 5.978.868-3.238 3.123 1.027 5.977L10 15.273z" />
                                                </svg>
                                                Unfavorite
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('favorites.store', $image->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit"
                                                class="text-yellow-500 hover:text-yellow-600 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 15.273l-4.79 2.52 1.027-5.977L1 6.691l5.978-.868L10 1l2.022 4.823 5.978.868-3.238 3.123 1.027 5.977L10 15.273z" />
                                                </svg>
                                                Favorite
                                            </button>
                                        </form>
                                        @endif
                                    </div>

                                    <!-- Shopping Cart Icon for Add to Cart -->
                                    @if (Auth::user()->id !== $image->user_id)
                                    <!-- Check if user is not the owner -->
                                    <form action="{{ route('carts.add', $image->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-gray-500 hover:text-blue-500"
                                            title="Add to Cart">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6 text-gray-500 hover:text-gray-700" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.6 2.3m1.6 6.7H17.4l1.3-5.7H8.6M16 17c0 1.1-.9 2-2 2s-2-.9-2-2s.9-2 2-2s2 .9 2 2zm-6 0c0 1.1-.9 2-2 2s-2-.9-2-2s.9-2 2-2s2 .9 2 2z" />
                                            </svg>
                                        </button>
                                    </form>
                                    @else
                                    <button class="text-gray-500 hover:text-blue-500" title="No Shoppig">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-6 w-6 text-gray-500 hover:text-gray-700" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.6 2.3m1.6 6.7H17.4l1.3-5.7H8.6M16 17c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2zm-6 0c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2z" />
                                            <!-- Adding a diagonal line across the shopping cart -->
                                            <line x1="2" y1="2" x2="22" y2="22" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" />
                                        </svg>

                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if ($images->isEmpty())
                    <p class="text-gray-500">{{ __('No images available.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>