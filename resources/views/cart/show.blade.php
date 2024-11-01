<x-app-layout>
    <x-slot name="header">
        <h2 class="font-normal tracking-wide text-[26px]  text-gray-200 leading-tight text-center mb-6">
            {{ __('My Cart') }}
        </h2>
        <hr class="m-2">
        </hr>
        <!-- Flash message -->
        @if(session('success'))
        <div id="flashMessage" class="bg-green-500 text-white p-4 rounded mt-4">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div id="flashMessage" class="bg-red-500 text-white p-4 rounded mt-4">
            {{ session('error') }}
        </div>
        @endif

        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-[550px]">
                <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class=" text-gray-100 font-normal tracking-wide">
                        @if($carts->isEmpty())
                        <p>Your cart is empty.</p>
                        @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                            @php
                            $totalPrice = 0;
                            @endphp

                            @foreach($carts as $cart)
                            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                                <a href="{{ route('images.show', $cart->image->id) }}">
                                    <img class="w-full h-[300px] object-cover"
                                        src="{{ asset('storage/' . $cart->image->path) }}"
                                        alt="{{ $cart->image->title }}">
                                    <div class="px-6 py-4">
                                        <div class="font-bold text-xl text-gray-800">{{ $cart->image->title }}</div>
                                        <p class="text-gray-500 text-base">
                                            {{ Str::limit($cart->image->description, 100) }}
                                        </p>
                                        <p class="text-red-500">
                                            Price: ${{ number_format($cart->image->price, 2) }}
                                        </p>
                                    </div>
                                </a>
                                <div class="px-6 pb-4 float-right">
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

                        <hr>
                        </hr>

                        <!-- Display Total Price -->
                        <div class="mt-6 font-normal tracking-wide">
                            @php
                            // ดึงระดับสมาชิกของผู้ใช้
                            $memberLevel = Auth::user()->member_level ?? null;
                            $discountRate = 0;

                            // กำหนดส่วนลดตามระดับสมาชิก
                            if ($memberLevel === "Bronze") {
                            $discountRate = 0.10;
                            } elseif ($memberLevel === "Silver") {
                            $discountRate = 0.20;
                            } elseif ($memberLevel === "Gold") {
                            $discountRate = 0.30;
                            } elseif ($memberLevel === "Platinum") {
                            $discountRate = 0.40;
                            } elseif ($memberLevel === "Diamond") {
                            $discountRate = 0.50;
                            } elseif ($memberLevel === "Ultimate") {
                            $discountRate = 0.60; // Semicolon added here
                            }

                            // คำนวณราคาหลังหักส่วนลด
                            $discountedPrice = $totalPrice - ($totalPrice * $discountRate);
                            @endphp


                            <!-- แสดงราคาขีดค่าเมื่อมีส่วนลด -->
                            @if ($discountRate > 0)
                            <p>
                                <strong>Total Price (Before Discount): </strong>
                                <span style="text-decoration: line-through;">
                                    ${{ number_format($totalPrice, 2) }}
                                </span>
                            </p>
                            <p>
                                <strong>Total Price for {{ Auth::user()->name }} (After {{ $discountRate * 100 }}%
                                    Discount): </strong>
                                <span style="color: red;">
                                    ${{ number_format($discountedPrice, 2) }}
                                </span>
                            </p>
                            @else
                            <!-- กรณีไม่มีส่วนลด -->
                            <strong>Total Price for {{ Auth::user()->name }}:
                                ${{ number_format($totalPrice, 2) }}</strong>
                            @endif
                        </div>


                        <!-- Checkout Button -->
                        <div class="mt-4 ">
                            <form action="{{ route('checkout') }}" method="GET">
                                @csrf
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                                    Checkout
                                </button>
                            </form>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <script>
        // กำหนดเวลาให้ Flash Message หายไปหลัง 3 วินาที (3000 milliseconds)
        setTimeout(() => {
            const flashMessage = document.getElementById('flashMessage');
            if (flashMessage) {
                flashMessage.style.transition = 'opacity 0.5s';
                flashMessage.style.opacity = '0';
                setTimeout(() => flashMessage.remove(), 500); // ลบออกจาก DOM หลังจากที่จางหายไป
            }
        }, 3000); // 3 วินาที
    </script>
</x-app-layout>