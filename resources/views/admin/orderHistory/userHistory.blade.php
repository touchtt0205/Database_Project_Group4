{{-- resources/views/admin/orderHistory/userHistory.blade.php --}}
@if($orderHistories->isEmpty())
<p>No order history found for this user.</p>
@else
<table class="min-w-full bg-white">
    <thead>
        <tr>
            <th class="py-2">Order ID</th>
            <th class="py-2">Price</th>
            <th class="py-2">Status</th>
            <th class="py-2">Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orderHistories as $history)
        <tr>
            <td class="border px-4 py-2">{{ $history->order_id }}</td>
            <td class="border px-4 py-2">${{ $history->price }}</td>
            <td class="border px-4 py-2">{{ $history->status }}</td>
            <td class="border px-4 py-2">{{ $history->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif