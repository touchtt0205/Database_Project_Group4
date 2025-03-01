<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-700 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4 text-[#d7d7d7]">Welcome to the Admin Dashboard</h3>

                    {{-- Flexbox Layout --}}
                    <div class="flex flex-col sm:flex-row gap-4">
                        {{-- Sidebar --}}
                        <div class="flex-shrink-0 w-full sm:w-1/4">
                            <a href="{{ route('admin.slips.index') }}"
                                class="flex items-center p-6 bg-blue-500 text-white rounded-lg hover:bg-blue-700 mb-4 transition duration-300">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="..."></path>
                                </svg>
                                Manage Slips
                            </a>
                            <a href="{{ route('admin.membership.index') }}"
                                class="flex items-center p-6 bg-purple-500 text-white rounded-lg hover:bg-purple-700 mb-4 transition duration-300">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="..."></path> <!-- Replace with appropriate SVG path -->
                                </svg>
                                Manage Memberships
                            </a>
                            <a href="{{ route('admin.users.index') }}"
                                class="flex items-center p-6 bg-green-500 text-white rounded-lg hover:bg-green-700 mb-4 transition duration-300">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="..."></path>
                                </svg>
                                Manage Users
                            </a>
                            <a href="{{ route('admin.tags.index') }}"
                                class="flex items-center p-6 bg-green-500 text-white rounded-lg hover:bg-green-700 mb-4 transition duration-300">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="..."></path>
                                </svg>
                                Manage Tags
                            </a>

                            <a href="{{ route('admin.orderHistory.index') }}"
                                class="flex items-center p-6 bg-yellow-500 text-white rounded-lg hover:bg-yellow-700 mb-4 transition duration-300">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="..."></path>
                                </svg>
                                View Order History
                            </a>


                        </div>

                        {{-- Main Content --}}
                        <div class="flex-grow">
                            <h4 class="text-lg font-bold text-center text-[#d7d7d7]">Overview</h4>
                            <div class="flex justify-center mt-4">
                                <div class="bg-pink-100 p-6 rounded-lg shadow mx-2 text-center w-1/3">
                                    <p class="font-bold text-teal-900">Total Users:</p>
                                    <p class="text-xl text-teal-900">{{ $userCount }}</p>
                                </div>
                                <div class="bg-yellow-100 p-6 rounded-lg shadow mx-2 text-center w-1/3">
                                    <p class="font-bold text-violet-900">Total Amount Spent:</p>
                                    <p class="text-xl text-violet-900">${{ number_format($totalSpent, 2) }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>