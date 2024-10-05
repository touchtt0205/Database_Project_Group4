<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Purchased Images') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Your Purchased Images</h3>

                    @if($purchasedImages->isEmpty())
                    <p>You have not purchased any images yet.</p>
                    @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($purchasedImages as $purchase)
                        <div class="max-w-sm rounded overflow-hidden shadow-lg">
                            <a href="{{ route('images.show', $purchase->image->id) }}">
                                <img class="w-full h-48 object-cover"
                                    src="{{ asset('storage/' . $purchase->image->path) }}"
                                    alt="{{ $purchase->image->title }}">
                                <div class="px-6 py-4">
                                    <div class="font-bold text-xl mb-2">{{ $purchase->image->title }}</div>
                                    <p class="text-gray-700 text-base">
                                        {{ Str::limit($purchase->image->description, 100) }}
                                    </p>
                                    <p class="text-gray-700 text-base">
                                        <strong>Price:</strong> ${{ number_format($purchase->image->price, 2) }}
                                    </p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>