<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('สินค้าของ: ' . $user->name) }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">สินค้าที่ {{ $user->name }} เพิ่ม</h1>

        @if ($products->isEmpty())
        <p class="text-gray-500">ไม่มีสินค้าที่เพิ่มโดย {{ $user->name }}</p>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                @if ($product->image_path)
                <img class="w-full h-48 object-cover" src="{{ Storage::url($product->image_path) }}"
                    alt="{{ $product->name }}">
                @else
                <img class="w-full h-48 object-cover" src="https://via.placeholder.com/400x300?text=No+Image"
                    alt="No Image">
                @endif
                <div class="p-4">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $product->name }}</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $product->description }}</p>
                    <p class="text-green-500 font-bold mt-2">ราคา: {{ number_format($product->price, 2) }} บาท</p>
                    <p class="text-gray-500 mt-1">จำนวน: {{ $product->quantity }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</x-app-layout>