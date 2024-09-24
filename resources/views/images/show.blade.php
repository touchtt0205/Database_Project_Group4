<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Image Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold">{{ $image->title }}</h3>
                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->title }}" class="mt-4 mb-4">
                    <p><strong>Description:</strong> {{ $image->description }}</p>
                    <p><strong>Price:</strong> ${{ $image->price }}</p>
                    <p><strong>Max Sales:</strong> {{ $image->max_sales }}</p>
                    <div class="mt-4">
                        <span class="text-gray-600">เพิ่มโดย:</span>
                        @if ($image->user)
                        <a href="{}" class="text-blue-500 hover:underline">
                            {{ $image->user->name }}
                        </a>
                        @else
                        <span class="text-gray-500">ไม่ทราบชื่อผู้ใช้</span>
                        @endif
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('images.index') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Back to Images
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>