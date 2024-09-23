<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ตะกร้าสินค้า') }}
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

            <form id="cart-form" method="POST" action="{{ route('carts.checkout') }}">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($carts as $cart)
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
                        @if ($cart->product->image_path)
                        <img src="{{ Storage::url($cart->product->image_path) }}" alt="{{ $cart->product->name }}"
                            class="w-full h-auto rounded-md">
                        @endif
                        <h2 class="text-lg font-bold mt-2">{{ $cart->product->name }}</h2>
                        <p class="mt-2 text-gray-600">ราคา: {{ number_format($cart->product->price, 2) }} บาท</p>
                        <p class="mt-2">จำนวน: {{ $cart->quantity }}</p>
                        <div class="flex items-center mt-4">
                            <form action="{{ route('carts.update', $cart->id) }}" method="POST"
                                class="flex items-center">
                                @csrf
                                @method('PATCH')
                                <button type="button" name="action" value="decrease"
                                    class="text-red-500 hover:underline"
                                    onclick="changeQuantity('{{ $cart->id }}', -1)">-</button>
                                <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1"
                                    class="border rounded w-16 text-center mx-2" id="quantity-{{ $cart->id }}">
                                <button type="button" name="action" value="increase"
                                    class="text-green-500 hover:underline"
                                    onclick="changeQuantity('{{ $cart->id }}', 1)">+</button>
                            </form>
                            <form action="{{ route('carts.destroy', $cart->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline ml-4">ลบ</button>
                            </form>
                        </div>
                        <div class="mt-2">
                            <input type="checkbox" name="selected_products[]" value="{{ $cart->id }}">
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    <h3 class="text-xl font-bold">รวมราคา:
                        <span id="total-price">0.00</span> บาท
                    </h3>
                    <button type="button" id="calculate-total"
                        class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">คำนวณราคารวม</button>
                </div>



                <script>
                document.getElementById('calculate-total').addEventListener('click', function() {
                    const checkboxes = document.querySelectorAll('input[name="selected_products[]"]:checked');
                    let total = 0;

                    checkboxes.forEach((checkbox) => {
                        const productElement = checkbox.closest('.bg-white');
                        const price = parseFloat(productElement.querySelector('.text-gray-600')
                            .innerText.replace(
                                'ราคา: ', '').replace(' บาท', '').replace(',', ''));
                        const quantity = parseInt(productElement.querySelector('input[name="quantity"]')
                            .value);
                        total += price * quantity;
                    });

                    document.getElementById('total-price').innerText = total.toFixed(2);
                });

                function changeQuantity(cartId, increment) {
                    const quantityInput = document.getElementById(`quantity-${cartId}`);
                    let currentQuantity = parseInt(quantityInput.value);
                    currentQuantity += increment;

                    if (currentQuantity < 1) currentQuantity = 1; // Prevent negative quantity
                    quantityInput.value = currentQuantity;
                }
                </script>

</x-app-layout>