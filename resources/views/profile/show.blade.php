<x-app-layout>
    <x-slot name="header">
        <div class="text-center mb-6">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Profile of {{ $user->name }}
            </h2>
            @if($user->profile_photo)
            <!-- แสดงรูปโปรไฟล์ -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo"
                    class="w-32 h-32 object-cover rounded-full border-2 border-gray-300 shadow-lg">
            </div>
            @else
            <div class="flex justify-center mb-4">
                <div class="w-32 h-32 bg-gray-300 rounded-full"></div> <!-- Placeholder ถ้าไม่มีรูป -->
            </div>
            @endif

            <!-- ปุ่ม Edit Profile -->
            <div class="flex justify-center">
                <a href="{{ route('profile.edit') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                    Edit Profile
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">Uploaded Images</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @forelse($images as $image)
                        <div
                            class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->title }}"
                                class="w-full h-48 object-cover mb-2"> <!-- ปรับให้เต็ม card -->
                            <div class="p-4">
                                <h4 class="font-semibold text-md mb-2">{{ $image->title }}</h4>
                                <a href="{{ route('images.show', $image->id) }}"
                                    class="text-gray-500 hover:text-blue-500" title="View Details">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.5C6.75 4.5 3 12 3 12s3.75 7.5 9 7.5 9-7.5 9-7.5-3.75-7.5-9-7.5zM12 8.25a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500">{{ __('No images uploaded.') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>