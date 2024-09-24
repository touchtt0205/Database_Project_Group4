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
                                </div>
                            </a>
                            <div class="px-6 pb-4">
                                <form action="{{ route('carts.destroy', $cart->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        Remove from Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
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