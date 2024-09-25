<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Welcome to the Admin Dashboard</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="{{ route('admin.slips.index') }}"
                            class="block p-6 bg-blue-500 text-white rounded-lg hover:bg-blue-700 text-center">
                            Manage Slips
                        </a>
                        <a href="#" class="block p-6 bg-green-500 text-white rounded-lg hover:bg-green-700 text-center">
                            Manage Users
                        </a>
                        <a href="#"
                            class="block p-6 bg-yellow-500 text-white rounded-lg hover:bg-yellow-700 text-center">
                            Manage Transactions
                        </a>
                        <a href="#" class="block p-6 bg-red-500 text-white rounded-lg hover:bg-red-700 text-center">
                            View Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>