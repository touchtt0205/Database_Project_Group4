<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('รายการโปรด') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($favorites->isEmpty())
            <p>ไม่มีรายการโปรด</p>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($favorites as $favorite)
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
                    @if ($favorite->product->image_path)
                    <img src="{{ Storage::url($favorite->product->image_path) }}" alt="{{ $favorite->product->name }}"
                        class="w-full h-auto rounded-md mb-4">
                    @endif
                    <h2 class="text-lg font-bold">{{ $favorite->product->name }}</h2>
                    <p class="mt-2 text-gray-600">{{ number_format($favorite->product->price, 2) }} บาท</p>
                    <form action="{{ route('favorites.toggle', $favorite->product_id) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700">ลบออกจากรายการโปรด</button>
                    </form>
                </div>
                @endforeach


            </div>
            @endif
        </div>
    </div>
</x-app-layout>