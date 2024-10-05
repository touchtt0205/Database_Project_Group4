<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($carts->isEmpty())
                    <p>Your cart is empty.</p>
                    @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @php
                        $totalPrice = 0;
                        @endphp

                        @foreach($carts as $cart)
                        <div class="max-w-sm rounded overflow-hidden shadow-lg">
                            <a href="{{ route('images.show', $cart->image->id) }}">
                                <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $cart->image->path) }}"
                                    alt="{{ $cart->image->title }}">
                                <div class="px-6 py-4">
                                    <div class="font-bold text-xl mb-2">{{ $cart->image->title }}</div>
                                    <p class="text-gray-700 text-base">
                                        {{ Str::limit($cart->image->description, 100) }}
                                    </p>
                                    <p class="text-gray-900 dark:text-gray-200 mt-2">
                                        Price: ${{ number_format($cart->image->price, 2) }}
                                    </p>
                                </div>
                            </a>
                            <div class="px-6 pb-4">
                                <form action="{{ route('carts.destroy', $cart->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        @php
                        $totalPrice += $cart->image->price;
                        @endphp
                        @endforeach
                    </div>

                    <!-- Display Total Price -->
                    <div class="mt-6 text-lg">
                        <strong>Total Price: ${{ number_format($totalPrice, 2) }}</strong>
                    </div>

                    <!-- Checkout Button -->
                    <div class="mt-4">
                        <form action="{{ route('checkout') }}" method="GET">
                            @csrf
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Checkout
                            </button>
                        </form>
                    </div>
                    @endif

                    <!-- Flash message -->
                    @if(session('success'))
                    <div class="bg-green-500 text-white p-4 rounded mt-4">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="bg-red-500 text-white p-4 rounded mt-4">
                        {{ session('error') }}
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>