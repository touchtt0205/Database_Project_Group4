<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload Image') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700">Title</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">Description</label>
                            <textarea name="description" id="description" class="mt-1 block w-full"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-gray-700">Price</label>
                            <input type="number" name="price" id="price" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="max_sales" class="block text-gray-700">Max Sales</label>
                            <input type="number" name="max_sales" id="max_sales" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-gray-700">Image</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full" required>
                        </div>

                        <div>
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Upload Image
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>