<!-- resources/views/admin/users/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl dark:text-gray-200 leading-tight text-[#d7d7d7] text-center">
            {{ __('Manage Users') }}
        </h2>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-700 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-bold mb-4 text-[#d7d7d7]">User List</h3>
                        <table class="min-w-full border border-gray-300">
                            <thead>
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-[#d7d7d7]">ID</th>
                                    <th class="border border-gray-300 px-4 py-2 text-[#d7d7d7]">Name</th>
                                    <th class="border border-gray-300 px-4 py-2 text-[#d7d7d7]">Email</th>
                                    <th class="border border-gray-300 px-4 py-2 text-[#d7d7d7] ">Created At</th>
                                    <th class="border border-gray-300 px-4 py-2 text-[#d7d7d7]">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 text-[#d7d7d7]">{{ $user->id }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-[#d7d7d7]">{{ $user->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-[#d7d7d7]">{{ $user->email }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-[#d7d7d7]">{{ $user->created_at }}
                                    <td class="border border-gray-300 px-4 py-2 text-[#d7d7d7]"><a
                                            href="{{ route('profile.show', $user->id) }}"
                                            class="text-blue-500 hover:underline text-center">View</a>

                                    </td>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>


</x-app-layout>