<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Image Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold">{{ $image->title }}</h3>
                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->title }}" class="mt-4 mb-4">
                    <p><strong>Description:</strong> {{ $image->description }}</p>
                    <p><strong>Price:</strong> ${{ $image->price }}</p>
                    <p><strong>Max Sales:</strong>
                        @if ($image->max_sales === null)
                        Unlimited
                        @elseif ($image->max_sales > 0)
                        {{ $image->max_sales }} left
                        @else
                        Sold out
                        @endif
                    </p>
                    <div class="mt-4">
                        <span class="text-gray-600">Uploaded by:</span>
                        @if ($image->user)
                        <a href="#" class="text-blue-500 hover:underline">
                            {{ $image->user->name }}
                        </a>
                        @else
                        <span class="text-gray-500">Unknown User</span>
                        @endif
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('images.index') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Back to Images
                        </a>
                    </div>

                    <div class="mt-4">
                        {{-- ตรวจสอบว่าผู้ใช้ซื้อภาพแล้วหรือยัง --}}
                        @if ($hasPurchased)
                        {{-- หากผู้ใช้ซื้อภาพแล้ว ให้แสดงปุ่มดาวน์โหลด --}}
                        <a href="{{ route('images.download', $image->id) }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Download Image
                        </a>
                        @else
                        {{-- หากผู้ใช้ยังไม่ได้ซื้อ ตรวจสอบ max_sales --}}
                        @if ($image->max_sales !== 0)
                        {{-- หากภาพยังขายได้ และผู้ใช้ยังไม่ได้ซื้อ --}}
                        @if ($image->price > 0)
                        <form action="{{ route('images.buy', $image->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Buy Image for ${{ $image->price }}
                            </button>
                        </form>
                        @else
                        {{-- หากภาพนี้ฟรี --}}
                        <a href="{{ route('images.download', $image->id) }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Download Image (Free)
                        </a>
                        @endif
                        @else
                        {{-- หาก max_sales เป็น 0 และผู้ใช้ยังไม่ได้ซื้อภาพนี้ --}}
                        <p class="text-red-500 font-bold">This image is no longer available for sale or download.</p>
                        @endif
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>