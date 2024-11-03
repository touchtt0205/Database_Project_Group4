<x-app-layout>
    <x-slot name="header">
        <h2 class="font-normal tracking-wide text-[26px] text-gray-200 leading-tight  text-center">
            {{ __('Buy Membership') }}
        </h2>
        <hr class="m-2">
        </hr>
        <div class="py-2">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-[#141A24] dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($memberships as $membership)
                            <div class="w-full max-w-sm  bg-gray-700  sm:rounded-lg"
                                style="box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.3);">

                                <!-- Membership Level Section -->
                                <div class="p-3 rounded-t-lg" style="background: radial-gradient(circle,
                                @if($membership->level === 'Bronze') #fecf7d, #8c6239
                                @elseif($membership->level === 'Silver') #e5eaf0, #a9a9a9
                                @elseif($membership->level === 'Gold') #fdfde2, #d4af37
                                @elseif($membership->level === 'Platinum') #cffef6, #a3bae6
                                @elseif($membership->level === 'Diamond') #cbb5cc , #ad7cdd
                                @elseif($membership->level === 'Ultimate') #fac8f7, #97193e
                                @else #d1d5db, #a8a8a8 @endif
                                );">
                                    <h5 class="text-2xl font-bold text-black-100 text-center price-shadow">
                                        {{ ucfirst($membership->level) }}
                                    </h5>
                                </div>

                                <!-- Details Section -->
                                <div class="bg-gray-700 p-5 sm:rounded-lg">
                                    <!-- Highlighted Price Section -->
                                    <p class="mb-3 text-2xl font-semibold text-center text-gray-100 ">
                                        ${{ number_format($membership->price) }} ฿
                                    </p>

                                    <p class="mb-3 font-normal text-gray-400 white:text-white-400 text-center">
                                        Privileges: {{ $membership->benefits }}
                                    </p>

                                    <!-- Centered Button Section -->
                                    <div class="flex justify-center mt-3">
                                        <button
                                            class="px-4 tracking-wide py-2 text-sm font-light text-center text-white bg-[#4888bf] rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                            onclick="showQrCode({{ $membership->price }}, '{{ $membership->level }}')">
                                            Buy Membership
                                        </button>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- QR Code Modal -->
        <div id="qrModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
            <div class="bg-black bg-opacity-50 absolute inset-0"></div>
            <div class="bg-white rounded-lg p-4 z-10 w-full max-w-md max-h-[800px] overflow-y-auto shadow-xl">
                <h3 class="text-[26px] font-bold text-center text-gray-800  mb-3">Scan to Pay </h3>
                <div class="flex justify-center mb-2">
                    <img src="https://secure1.zimple.cloud/images/thai_qr_payment.png" alt="PromptPay Logo"
                        class="h-[80px]">
                </div>
                <div class="flex justify-center mb-3">
                    <img id="qrImage" class="w-40 h-100 rounded-lg shadow-md" src="" alt="QR Code" />
                </div>
                <span class="flex justify-center text-[#4fbeae]">สแกน QR เพื่อโอนเงินเข้าบัญชี</span>
                <span class="flex justify-center mr-auto ml-auto">ชื่อ: นาย สิปปกร คำมีสว่าง</span>
                <hr class="m-2 border-t-1 border-[#23a15d]" />

                <div class="flex justify-center text-lg text-red-800 mt-2">
                    ยอดที่ต้องชำระ: <span id="amountDisplay" class="mr-1 ml-1"></span> ฿
                </div>
                <div class="text-center text-gray-400  mb-3" id="modalContent"></div>
                <form id="uploadSlipForm" action="{{ route('member.slips.store') }}" method="POST"
                    enctype="multipart/form-data" class="text-center">
                    @csrf
                    <input type="hidden" name="amount" id="membershipAmount" value="">
                    <input type="hidden" name="membership_name" id="membershipName" value="">
                    <label class="block text-md font-medium text-gray-400 mt-3">Upload Payment
                        Slip</label>
                    <input type="file" name="slip_path" accept="image/*" required
                        class="mt-2 mb-3 px-3 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <button type="submit"
                        class="w-full py-2 mb-3 text-md font-normal text-white bg-green-600 hover:bg-green-700 rounded-lg shadow-md">
                        Upload Slip
                    </button>
                </form>
                <button onclick="closeModal()"
                    class="w-full py-2 mb-3 text-md font-normal text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-md">
                    Close
                </button>
            </div>
        </div>


        <style>
            .price-shadow {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
                /* เงาสีดำบางๆ */
            }
        </style>

        <script>
            function showQrCode(amount, membershipName) {
                const promptpayId = '0885755068';
                const formattedAmount = amount.toFixed(2);
                const qrCodeUrl = `https://promptpay.io/${promptpayId}/${formattedAmount}.png`;
                document.getElementById('qrImage').src = qrCodeUrl;
                document.getElementById('modalContent').innerText = `Please pay ฿${amount} for ${membershipName}.`;
                document.getElementById('membershipAmount').value = amount;
                document.getElementById('membershipName').value = membershipName;
                document.getElementById('qrModal').classList.remove('hidden');
                document.getElementById('amountDisplay').innerText = amount;
            }

            function closeModal() {
                document.getElementById('qrModal').classList.add('hidden');
            }
        </script>
    </x-slot>

</x-app-layout>
