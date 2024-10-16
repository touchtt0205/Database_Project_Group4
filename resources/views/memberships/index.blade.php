<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buy Membership') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($memberships as $membership)
                        <div class="max-w-sm bg-white dark:bg-gray-700 border border-gray-200 rounded-lg shadow-md">
                            <div class="p-5">
                                <h5 class="mb-2 text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ $membership->level }}
                                    <!-- เปลี่ยนจาก name เป็น level -->
                                </h5>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    Price: ${{ number_format($membership->price, 2) }} ฿
                                </p>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    Privileges: {{ $membership->benefits }}
                                    <!-- หากคุณยังต้องการแสดง benefits สามารถเก็บไว้ได้ -->
                                </p>
                                <button
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    onclick="showQrCode({{ $membership->price }}, '{{ $membership->level }}')">
                                    <!-- เปลี่ยนจาก benefits เป็น level -->
                                    Buy Now
                                </button>
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
        <div class="bg-white rounded-lg p-8 z-10 w-full max-w-lg shadow-xl">
            <h3 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-4">Scan to Pay</h3>
            <!-- PromptPay Logo -->
            <div class="flex justify-center mb-2">
                <img src="https://secure1.zimple.cloud/images/thai_qr_payment.png" alt="PromptPay Logo"
                    class="h-13 w-13">
            </div>
            <div class="flex justify-center mb-4">
                <img id="qrImage" class="w-64 h-64 rounded-lg shadow-md" src="" alt="QR Code" />
            </div>
            <span class="flex justify-center text-[#4fbeae]">สแกน QR เพื่อโอนเงินเข้าบัญชี</span>
            <span class="flex justify-center mr-auto ml-auto">ชื่อ: นาย สิปปกร คำมีสว่าง</span>
            <hr class="m-2 border-t-2 border-[#23a15d]" />
            <!-- Amount information below the line -->
            <div class="flex justify-center text-lg text-gray-800 dark:text-gray-100 mt-4">
                ยอดที่ต้องชำระ: <span id="amountDisplay" class="mr-1 ml-1"></span> ฿
            </div>
            <div class="text-center text-gray-700 dark:text-gray-200 mb-4" id="modalContent"></div>
            <form id="uploadSlipForm" action="{{ route('member.slips.store') }}" method="POST"
                enctype="multipart/form-data" class="text-center">
                @csrf
                <input type="hidden" name="amount" id="membershipAmount" value="">
                <input type="hidden" name="membership_name" id="membershipName" value="">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Upload Payment Slip</label>
                <input type="file" name="slip_path" accept="image/*" required
                    class="mt-2 mb-4 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <button type="submit"
                    class="w-full py-2 mb-4 text-lg font-semibold text-white bg-green-600 hover:bg-green-700 rounded-lg shadow-md">
                    Upload Slip
                </button>
            </form>
            <button onclick="closeModal()"
                class="w-full py-2 text-lg font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-md">
                Close
            </button>
        </div>
    </div>
    <!-- JavaScript to handle QR Code modal display -->
    <script>
    function showQrCode(amount, membershipName) {
        const promptpayId = '0885755068'; // Replace with your PromptPay ID
        const formattedAmount = amount.toFixed(2); // Ensure the amount has 2 decimal places
        const qrCodeUrl = `https://promptpay.io/${promptpayId}/${formattedAmount}.png`;
        // Log the values to the console
        console.log('Amount:', amount);
        console.log('Membership Name:', membershipName);
        document.getElementById('qrImage').src = qrCodeUrl; // Set QR Code URL
        document.getElementById('modalContent').innerText = `Please pay ฿${amount} for ${membershipName}.`;
        document.getElementById('membershipAmount').value = amount; // Set hidden input for amount
        document.getElementById('membershipName').value = membershipName; // Set hidden input for membership name
        document.getElementById('qrModal').classList.remove('hidden'); // Show modal
        document.getElementById('amountDisplay').innerText = amount;
    }

    function closeModal() {
        document.getElementById('qrModal').classList.add('hidden'); // Hide modal
    }
    </script>
</x-app-layout>