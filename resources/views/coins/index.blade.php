<x-app-layout>
    <x-slot name="header">
        <h2 class="font-normal tracking-wide text-[26px] text-gray-200 leading-tight text-center">
            {{ __('BUY COINS') }}
        </h2>
        <div class="py-5 min-h-[550px]">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-[#141A24] dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($cardsData as $card)
                            <div class="max-w-sm bg-[#aabedc]   rounded-lg shadow-md relative">
                                <!-- Container to align logo, text, and button in a single row -->
                                <div class="p-5 flex items-center justify-between">
                                    <!-- Logo on the left
                                    <img src="{{ asset('storage/images/logocoin.png') }}" alt="Coin Image"
                                        class="w-12 h-12 rounded-full border border-gray-300"> -->
                                    <div class="w-12 h-12 mr-4">
                                        <!-- SVG content here -->
                                        <!-- <svg height="100%" width="100%" version="1.1" id="Layer_1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 511.999 511.999"
                                            xml:space="preserve" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <circle style="fill:#00A8E1;" cx="316.026" cy="311.219" r="187.964">
                                                </circle>
                                                <path style="opacity:0.2;enable-background:new ;"
                                                    d="M308.016,499.002c2.657,0.111,5.325,0.182,8.01,0.182 s5.353-0.069,8.01-0.182v-74.598h-16.02V499.002z M177.578,184.098l52.75,52.752l11.328-11.328l-52.75-52.751 C184.972,176.384,181.192,180.163,177.578,184.098z M202.841,303.208h-74.598c-0.111,2.657-0.182,5.325-0.182,8.011 c0,2.685,0.069,5.352,0.182,8.009h74.598V303.208z M177.576,438.339c3.615,3.936,7.395,7.715,11.328,11.328l52.751-52.75 l-11.328-11.329L177.576,438.339z M454.473,184.098c-3.614-3.934-7.394-7.714-11.328-11.327l-52.751,52.751l11.329,11.328 L454.473,184.098z M503.809,303.208l-74.598-0.002v16.02l74.598,0.002c0.111-2.657,0.182-5.324,0.182-8.009 S503.921,305.866,503.809,303.208z M308.016,123.437v74.597h16.02v-74.597c-2.657-0.111-5.325-0.182-8.01-0.182 C313.342,123.255,310.673,123.325,308.016,123.437z M390.396,396.916l52.752,52.751c3.934-3.615,7.714-7.395,11.328-11.328 l-52.752-52.752L390.396,396.916z">
                                                </path>
                                                <circle style="fill:#333E48;" cx="316.026" cy="311.219" r="135.548">
                                                </circle>
                                                <path style="fill:#FFFFFF;"
                                                    d="M318.51,197.849c7.573,0,13.587,6.002,13.587,13.581v3.654c14.102,2.092,26.646,6.27,37.879,12.543 c4.961,2.874,9.398,7.829,9.398,15.672c0,9.927-7.836,17.5-17.766,17.5c-3.136,0-6.264-0.78-9.141-2.353 c-7.311-3.914-14.625-7.047-21.68-8.874v39.703c39.704,10.709,56.686,26.91,56.686,56.161c0,29.254-22.467,48.065-55.378,51.725 v13.842c0,7.578-6.014,13.586-13.587,13.586c-7.576,0-13.584-6.007-13.584-13.586V396.9c-18.547-2.353-36.054-8.88-51.463-18.285 c-5.488-3.4-8.887-8.623-8.887-15.673c0-10.19,7.839-17.77,18.029-17.77c3.4,0,7.057,1.311,10.191,3.402 c10.971,7.051,21.425,12.015,33.438,14.628v-41.535c-37.622-10.19-56.168-24.556-56.168-55.642c0-28.736,21.944-48.068,54.86-51.468 v-3.127C304.927,203.851,310.935,197.849,318.51,197.849z M306.235,282.48v-35.265c-12.542,1.829-18.026,8.1-18.026,16.455 C288.208,271.769,291.864,277.257,306.235,282.48z M330.787,328.2v36.305c12.273-1.824,18.549-7.578,18.549-16.977 C349.337,338.907,344.891,333.16,330.787,328.2z">
                                                </path>
                                                <circle style="fill:#FF9E16;" cx="195.974" cy="200.78" r="187.964">
                                                </circle>
                                                <path style="opacity:0.2;enable-background:new ;"
                                                    d="M57.527,73.658l52.75,52.752l11.328-11.328L68.856,62.33 C64.92,65.944,61.141,69.724,57.527,73.658z M187.964,388.562c2.657,0.111,5.325,0.182,8.01,0.182s5.353-0.069,8.01-0.182v-74.599 h-16.02V388.562z M57.525,327.898c3.615,3.936,7.395,7.715,11.328,11.328l52.752-52.751l-11.328-11.328L57.525,327.898z M82.79,192.769H8.191c-0.112,2.657-0.182,5.325-0.182,8.011c0,2.685,0.069,5.352,0.182,8.009H82.79V192.769z M187.964,12.997 v74.597h16.02V12.997c-2.657-0.111-5.325-0.182-8.01-0.182S190.622,12.886,187.964,12.997z M383.757,192.769l-74.598-0.002v16.02 l74.598,0.002c0.111-2.657,0.182-5.324,0.182-8.009C383.939,198.094,383.869,195.426,383.757,192.769z M334.422,73.658 c-3.614-3.934-7.394-7.714-11.328-11.327l-52.751,52.751l11.328,11.328L334.422,73.658z M270.344,286.476l52.751,52.752 c3.934-3.615,7.714-7.395,11.328-11.329l-52.751-52.751L270.344,286.476z">
                                                </path>
                                                <circle style="fill:#333E48;" cx="195.974" cy="200.78" r="135.548">
                                                </circle>
                                                <path style="fill:#FFFFFF;"
                                                    d="M198.458,87.409c7.573,0,13.587,6.002,13.587,13.581v3.654c14.102,2.092,26.646,6.27,37.879,12.543 c4.961,2.874,9.398,7.829,9.398,15.672c0,9.927-7.836,17.5-17.766,17.5c-3.136,0-6.264-0.78-9.141-2.353 c-7.311-3.914-14.625-7.047-21.68-8.874v39.703c39.704,10.709,56.686,26.91,56.686,56.161c0,29.255-22.467,48.065-55.378,51.725 v13.842c0,7.578-6.014,13.586-13.587,13.586c-7.576,0-13.584-6.007-13.584-13.586V286.46c-18.547-2.353-36.054-8.88-51.463-18.285 c-5.488-3.4-8.887-8.623-8.887-15.673c0-10.19,7.839-17.77,18.029-17.77c3.4,0,7.057,1.311,10.191,3.402 c10.971,7.051,21.424,12.015,33.438,14.628v-41.535c-37.622-10.19-56.168-24.556-56.168-55.642c0-28.736,21.944-48.068,54.86-51.468 v-3.127C184.875,93.411,190.882,87.409,198.458,87.409z M186.183,172.04v-35.265c-12.542,1.829-18.026,8.1-18.026,16.455 C168.157,161.33,171.812,166.817,186.183,172.04z M210.736,217.759v36.305c12.273-1.824,18.549-7.578,18.549-16.977 C229.286,228.467,224.838,222.72,210.736,217.759z">
                                                </path>
                                                <g>
                                                    <path style="fill:#1E252B;"
                                                        d="M195.974,396.754C87.913,396.754,0,308.841,0,200.78S87.913,4.805,195.974,4.805 S391.948,92.718,391.948,200.78S304.036,396.754,195.974,396.754z M195.974,20.825c-99.227,0-179.955,80.727-179.955,179.955 s80.727,179.955,179.955,179.955s179.954-80.727,179.954-179.955S295.201,20.825,195.974,20.825z">
                                                    </path>
                                                    <path style="fill:#1E252B;"
                                                        d="M195.974,344.33c-79.155,0-143.552-64.397-143.552-143.551c0-79.155,64.397-143.554,143.552-143.554 s143.552,64.398,143.552,143.554C339.527,279.933,275.13,344.33,195.974,344.33z M195.974,73.245 c-70.322,0-127.533,57.211-127.533,127.534c0,70.321,57.211,127.532,127.533,127.532S323.507,271.1,323.507,200.779 C323.507,130.455,266.296,73.245,195.974,73.245z">
                                                    </path>
                                                    <path style="fill:#1E252B;"
                                                        d="M316.026,507.194c-40.009,0-78.489-11.98-111.284-34.641c-32.03-22.134-56.538-52.884-70.876-88.926 l14.884-5.922c13.166,33.097,35.677,61.337,65.099,81.669c30.105,20.804,65.438,31.8,102.178,31.8 c99.227,0,179.955-80.727,179.955-179.955c0-39.382-12.485-76.778-36.107-108.146c-22.856-30.351-55.353-53.108-91.506-64.081 l4.651-15.33c39.377,11.951,74.768,36.731,99.651,69.773c25.73,34.168,39.329,74.896,39.329,117.782 C512,419.281,424.087,507.194,316.026,507.194z">
                                                    </path>
                                                    <path style="fill:#1E252B;"
                                                        d="M316.026,454.77c-46.971,0-91.051-23.048-117.912-61.653l13.15-9.148 c23.869,34.303,63.032,54.783,104.763,54.783c70.322,0,127.533-57.211,127.533-127.532c0-45.326-24.386-87.63-63.642-110.401 l8.039-13.857c44.178,25.626,71.623,73.24,71.623,124.258C459.578,390.373,395.18,454.77,316.026,454.77z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg> -->
                                        <svg height="100%" width="100%" version="1.1" id="Layer_1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                            xml:space="preserve" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <circle style="fill:#324A5E;" cx="256" cy="256" r="256"></circle>
                                                <path style="fill:#2B3B4E;"
                                                    d="M272.236,511.472c129.586-8.113,233.031-112.614,239.445-242.652L393.53,150.669l-135.228,91.539 L105.543,344.781L272.236,511.472z">
                                                </path>
                                                <path style="fill:#F9B54C;"
                                                    d="M381.702,202.559H244.077c-9.125,0-16.52-7.397-16.52-16.522v-23.845 c0-9.125,7.397-16.522,16.52-16.522h137.625c9.125,0,16.52,7.397,16.52,16.522v23.847 C398.222,195.162,390.825,202.559,381.702,202.559z">
                                                </path>
                                                <path style="fill:#FFD15D;"
                                                    d="M381.702,259.448H244.077c-9.125,0-16.52-7.397-16.52-16.52v-23.847 c0-9.125,7.397-16.522,16.52-16.522h137.625c9.125,0,16.52,7.397,16.52,16.522v23.847 C398.222,252.051,390.825,259.448,381.702,259.448z">
                                                </path>
                                                <path style="fill:#F9B54C;"
                                                    d="M381.702,316.337H244.077c-9.125,0-16.52-7.397-16.52-16.52V275.97c0-9.125,7.397-16.52,16.52-16.52 h137.625c9.125,0,16.52,7.397,16.52,16.52v23.847C398.222,308.939,390.825,316.337,381.702,316.337z">
                                                </path>
                                                <path style="fill:#FFD15D;"
                                                    d="M381.702,373.226H244.077c-9.125,0-16.52-7.397-16.52-16.52v-23.847c0-9.125,7.397-16.52,16.52-16.52 h137.625c9.125,0,16.52,7.397,16.52,16.52v23.847C398.222,365.828,390.825,373.226,381.702,373.226z">
                                                </path>
                                                <path style="fill:#F4A200;"
                                                    d="M381.702,145.67h-69.385v56.889h69.385c9.125,0,16.52-7.397,16.52-16.52V162.19 C398.222,153.067,390.825,145.67,381.702,145.67z">
                                                </path>
                                                <path style="fill:#F9B54C;"
                                                    d="M381.702,202.559h-69.385v56.889h69.385c9.125,0,16.52-7.397,16.52-16.52v-23.847 C398.222,209.956,390.825,202.559,381.702,202.559z">
                                                </path>
                                                <path style="fill:#F4A200;"
                                                    d="M381.702,259.448h-69.385v56.889h69.385c9.125,0,16.52-7.397,16.52-16.52V275.97 C398.222,266.845,390.825,259.448,381.702,259.448z">
                                                </path>
                                                <path style="fill:#F9B54C;"
                                                    d="M381.702,316.337h-69.385v56.889h69.385c9.125,0,16.52-7.397,16.52-16.52v-23.847 C398.222,323.734,390.825,316.337,381.702,316.337z">
                                                </path>
                                                <circle style="fill:#FFD15D;" cx="177.562" cy="279.273" r="78.438">
                                                </circle>
                                                <g>
                                                    <path style="fill:#F9B54C;"
                                                        d="M177.562,200.835c-0.193,0-0.381,0.014-0.574,0.014v156.846c0.191,0.002,0.381,0.014,0.574,0.014 c43.32,0,78.438-35.118,78.438-78.438S220.882,200.835,177.562,200.835z">
                                                    </path>
                                                    <path style="fill:#F9B54C;"
                                                        d="M177.562,376.673c-53.707,0-97.401-43.694-97.401-97.401s43.694-97.401,97.401-97.401 s97.401,43.694,97.401,97.401S231.269,376.673,177.562,376.673z M177.562,219.798c-32.794,0-59.475,26.681-59.475,59.475 c0,32.794,26.681,59.475,59.475,59.475s59.475-26.681,59.475-59.475C237.037,246.479,210.356,219.798,177.562,219.798z">
                                                    </path>
                                                </g>
                                                <path style="fill:#F4A200;"
                                                    d="M177.562,181.872c-0.193,0-0.381,0.014-0.574,0.014v37.926c0.191-0.002,0.381-0.014,0.574-0.014 c32.794,0,59.475,26.681,59.475,59.475c0,32.794-26.681,59.475-59.475,59.475c-0.193,0-0.381-0.012-0.574-0.014v37.926 c0.191,0.002,0.381,0.014,0.574,0.014c53.707,0,97.401-43.694,97.401-97.401S231.269,181.872,177.562,181.872z">
                                                </path>
                                            </g>
                                        </svg>
                                    </div>

                                    <!-- Text content in the center -->
                                    <div class="flex-1 mx-4">
                                        <h5 class="text-xl font-bold text-gray-900 dark:text-white">
                                            {{ $card['quantity'] }} Coins
                                        </h5>
                                        <p class="text-sm text-gray-700 dark:text-gray-400">
                                            Price: ${{ number_format($card['price'], 2) }}
                                        </p>
                                    </div>

                                    <!-- Button on the right -->
                                    <button
                                        class="py-2 px-4 text-sm font-medium text-white bg-[#4888bf] rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        onclick="showQrCode({{ $card['price'] }}, {{ $card['quantity'] }})">
                                        Buy
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

            <div class="bg-white rounded-lg p-4 z-10 w-full max-w-md shadow-xl max-h-[800px]">
                <h3 class="text-xl font-bold text-center text-gray-800 mb-4">Scan to Pay</h3>
                <div class="flex justify-center mb-2">
                    <img src="https://secure1.zimple.cloud/images/thai_qr_payment.png" alt="PromptPay Logo"
                        class="h-[70px]">
                </div>
                <div class="flex justify-center mb-4">
                    <img id="qrImage" class="w-48 h-48 rounded-lg shadow-md" src="" alt="QR Code" />
                </div>
                <span class="flex justify-center text-[#4fbeae]">สแกน QR เพื่อโอนเงินเข้าบัญชี</span>
                <span class="flex justify-center mr-auto ml-auto">ชื่อ: นาย สิปปกร คำมีสว่าง</span>
                <hr class="m-2 border-t-1 border-[#23a15d]" />
                <div class="flex justify-center text-lg text-red-800 mt-2">

                    ยอดที่ต้องชำระ: <span id="amountDisplay" class="mr-1 ml-1"></span> ฿
                </div>
                <div class="text-center text-gray-700 mb-4" id="modalContent"></div>

                <form id="uploadSlipForm" action="{{ route('slips.store') }}" method="POST"
                    enctype="multipart/form-data" class="text-center">
                    @csrf
                    <input type="hidden" name="amount" id="slipAmount" value="">
                    <input type="hidden" name="quantity" id="slipQuantity" value="">

                    <label class="block text-sm font-medium text-gray-700">Upload Payment Slip</label>
                    <input type="file" name="slip_path" accept="image/*" required
                        class="mt-2 mb-4 px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">

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

        <script>
            function showQrCode(amount, quantity) {
                const promptpayId = '0885755068';
                const formattedAmount = amount.toFixed(2);
                const qrCodeUrl = `https://promptpay.io/${promptpayId}/${formattedAmount}.png`;

                document.getElementById('qrImage').src = qrCodeUrl;
                document.getElementById('modalContent').innerText = `Please pay ฿${amount} for ${quantity} coins.`;
                document.getElementById('slipAmount').value = amount;
                document.getElementById('slipQuantity').value = quantity;
                document.getElementById('qrModal').classList.remove('hidden');
                document.getElementById('amountDisplay').innerText = amount;
            }

            function closeModal() {
                document.getElementById('qrModal').classList.add('hidden');
            }
        </script>
    </x-slot>

</x-app-layout>