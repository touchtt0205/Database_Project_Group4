<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold">{{ $product->name }}</h1>

                <!-- แสดงรูปภาพสินค้า -->
                @if ($product->image_path)
                <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}"
                    class="mt-4 w-full h-auto rounded-md">
                @endif

                <p class="mt-2 text-gray-600">{{ $product->description }}</p>
                <p class="mt-4 text-lg font-semibold">ราคา: {{ number_format($product->price, 2) }} บาท</p>
                <p class="mt-2">จำนวน: {{ $product->quantity }}</p>

                <!-- แสดงชื่อผู้ใช้ที่เพิ่มสินค้า -->
                <div class="mt-4">
                    <span class="text-gray-600">เพิ่มโดย:</span>
                    @if ($product->user)
                    <a href="{{ route('products.user', $product->user_id) }}" class="text-blue-500 hover:underline">
                        {{ $product->user->name }}
                    </a>
                    @else
                    <span class="text-gray-500">ไม่ทราบชื่อผู้ใช้</span>
                    @endif
                </div>

                <div class="mt-4 flex space-x-4">
                    <a href="{{ route('products.index') }}"
                        class="text-blue-500 hover:underline">กลับไปที่รายการสินค้า</a>

                    <!-- ปุ่มลบสินค้า -->
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                        onsubmit="return confirm('คุณแน่ใจว่าต้องการลบสินค้านี้?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">ลบสินค้า</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>