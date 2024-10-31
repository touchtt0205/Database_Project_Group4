{{-- resources/views/admin/orderHistory/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Order History</h3>

                    @if($orderHistories->isEmpty())
                    <p>No order history found.</p>
                    @else
                    <table class="min-w-full ">
                        <thead>
                            <tr>
                                <th class="py-2 text-gray-200">User ID</th>
                                <th class="py-2 text-gray-200">Order ID</th>

                                <th class="py-2 text-gray-200">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderHistories as $history)
                            <tr>
                                <td class="border px-4 py-2">{{ $history->user_id }}</td>
                                <td class="border px-4 py-2">{{ $history->order_id }}</td>

                                <td class="border px-4 py-2">
                                    <button onclick="showUserHistory({{ $history->user_id }})"
                                        class="text-blue-500 hover:underline">View User History</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div id="userHistoryModal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg overflow-hidden shadow-lg w-11/12 md:w-1/2">
            <div class="p-6">
                <h3 class="text-lg font-bold mb-4">User Order History</h3>
                <div id="modalContent">
                    <!-- Content will be populated with AJAX -->
                </div>
                <button onclick="closeModal()" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Close</button>
            </div>
        </div>
    </div>





    <script>
        function showUserHistory(userId) {
            // Make an AJAX request to get the user's order history
            fetch(`/admin/order-history/user/${userId}`)
                .then(response => response.text())
                .then(data => {
                    // Populate the modal content
                    document.getElementById('modalContent').innerHTML = data;
                    // Show the modal
                    document.getElementById('userHistoryModal').classList.remove('hidden');
                });
        }

        function closeModal() {
            document.getElementById('userHistoryModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
