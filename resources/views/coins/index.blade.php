<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Coins') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl mb-4">Choose your coins:</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($cardsData as $card)
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                            <h3 class="text-lg font-bold">{{ $card['quantity'] }} Coins</h3>
                            <p class="text-gray-600">${{ number_format($card['price'], 2) }}</p>
                            <button class="mt-2 bg-blue-500 text-white py-2 px-4 rounded">
                                Add to Cart
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>