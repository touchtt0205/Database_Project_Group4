<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('เพิ่มสินค้า') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">ชื่อสินค้า:</label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="description"
                            class="block text-sm font-medium text-gray-700">รายละเอียดสินค้า:</label>
                        <textarea name="description" id="description" required
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">ราคา:</label>
                        <input type="number" name="price" id="price" required
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">จำนวน:</label>
                        <input type="number" name="quantity" id="quantity" required
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">อัปโหลดรูปภาพ:</label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <button type="submit"
                        class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">เพิ่มสินค้า</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>