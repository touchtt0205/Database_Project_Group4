<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('รายการสินค้า') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <strong class="font-bold">สำเร็จ!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
                    @if ($product->image_path)
                    <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}"
                        class="w-full h-auto rounded-md">
                    @endif
                    <h2 class="text-lg font-bold mt-2">{{ $product->name }}</h2>
                    <div class="mt-4 flex justify-between">
                        <!-- ไอคอนเพิ่มลงตะกร้า -->
                        <form action="{{ route('carts.store', $product->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" class="border rounded w-16" required>
                            <button type="submit" class="text-green-500 hover:text-green-700">
                                <i class="fas fa-shopping-cart fa-lg"></i>
                            </button>
                        </form>

                        <!-- ไอคอนดูรายละเอียด -->
                        <a href="{{ route('products.show', $product->id) }}" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-eye fa-lg"></i>
                        </a>

                        <!-- ปุ่มลบสินค้า -->
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                            onsubmit="return confirm('คุณแน่ใจว่าจะลบสินค้านี้?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash fa-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>