<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Coins') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('coins.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" name="quantity" id="quantity"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price" id="price" step="0.01"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                            Add Coins
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>