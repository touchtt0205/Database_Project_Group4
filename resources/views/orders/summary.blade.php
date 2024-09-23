<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('สรุปคำสั่งซื้อ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($carts->isEmpty())
            <p>ไม่มีสินค้าที่จะสรุปคำสั่งซื้อ</p>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($carts as $cart)
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
                    @if ($cart->product->image_path)
                    <img src="{{ Storage::url($cart->product->image_path) }}" alt="{{ $cart->product->name }}"
                        class="w-full h-auto rounded-md">
                    @endif
                    <h2 class="text-lg font-bold mt-2">{{ $cart->product->name }}</h2>
                    <p class="mt-2 text-gray-600">ราคา: {{ number_format($cart->product->price, 2) }} บาท</p>
                    <p class="mt-2">จำนวน: {{ $cart->quantity }}</p>
                </div>
                @endforeach
            </div>

            <div class="mt-6">
                <h3 class="text-xl font-bold">รวมราคา:
                    <span>
                        {{ number_format($carts->sum(fn($cart) => $cart->product->price * $cart->quantity), 2) }} บาท
                    </span>
                </h3>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>