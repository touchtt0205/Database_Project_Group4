<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#d7d7d7] dark:text-gray-200 leading-tight text-center">
            {{ __('Memberships Management') }}
        </h2>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-700 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if(session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger mb-4">
                            {{ session('error') }}
                        </div>
                        @endif

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Slip Id</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        User</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Benefits</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Slip Path</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-700 divide-y divide-gray-200">
                                @foreach($slips as $slip)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-[#d7d7d7]">{{ $slip->slip_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-[#d7d7d7]">{{ $slip->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-[#d7d7d7]">{{ $slip->amount }} ฿</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-[#d7d7d7]">{{ $slip->coins }} Coins</td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <img src="{{ asset('storage/' . $slip->slip_path) }}" alt="Slip Image"
                                            width="100" style="cursor:pointer;">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-[#d7d7d7]">{{ ucfirst($slip->status) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('admin.membership.approve', $slip->slip_id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-500 text-white px-4 py-2 rounded">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.membership.reject', $slip->slip_id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 text-white px-4 py-2 rounded">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if($slips->isEmpty())
                        <p class="mt-4 text-gray-500">{{ __("No slips found.") }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="slipModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg overflow-hidden shadow-lg max-w-lg w-full">
                <div class="p-4">
                    <h2 class="text-lg font-bold">Slip Details</h2>
                    <img id="modalSlipImage" src="" alt="Slip Image" class="my-4 w-full">
                    <p id="modalSlipInfo" class="text-gray-700"></p>
                    <button id="closeModal" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Close</button>
                </div>
            </div>
        </div>

        <script>
            document.querySelectorAll('img[alt="Slip Image"]').forEach(function(img) {
                img.addEventListener('click', function() {
                    const slipPath = this.src;
                    const slipInfo =
                        `Amount: ${this.closest('tr').querySelector('td:nth-child(3)').textContent} | Coins: ${this.closest('tr').querySelector('td:nth-child(4)').textContent}`;

                    document.getElementById('modalSlipImage').src = slipPath;
                    document.getElementById('modalSlipInfo').textContent = slipInfo;

                    document.getElementById('slipModal').classList.remove('hidden');
                });
            });

            document.getElementById('closeModal').addEventListener('click', function() {
                document.getElementById('slipModal').classList.add('hidden');
            });

            window.onclick = function(event) {
                if (event.target == document.getElementById('slipModal')) {
                    document.getElementById('slipModal').classList.add('hidden');
                }
            };
        </script>
    </x-slot>


</x-app-layout>