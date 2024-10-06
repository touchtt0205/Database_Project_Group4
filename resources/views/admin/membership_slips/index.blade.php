<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Membership Slips Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($slips->isEmpty())
                    <p>No membership slips found.</p>
                    @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Membership Level</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Slip Path</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Admin Note</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($slips as $slip)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $slip->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $slip->membershipLevel->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $slip->slip_path }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $slip->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $slip->admin_note }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.membership.approve', $slip->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="text-green-600 hover:text-green-800">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.membership.reject', $slip->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-800">Reject</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif

                    <!-- Flash messages -->
                    @if(session('success'))
                    <div class="bg-green-500 text-white p-4 rounded mt-4">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="bg-red-500 text-white p-4 rounded mt-4">
                        {{ session('error') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>