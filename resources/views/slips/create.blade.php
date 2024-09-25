<!-- resources/views/slips/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload Slip') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('slips.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="amount" class="block">Amount:</label>
                            <input type="number" name="amount" id="amount" required class="mt-1 block w-full" />
                        </div>
                        <div class="mt-4">
                            <label for="coins" class="block">Coins:</label>
                            <input type="number" name="coins" id="coins" required class="mt-1 block w-full" />
                        </div>
                        <div class="mt-4">
                            <label for="slip" class="block">Upload Slip:</label>
                            <input type="file" name="slip" id="slip" required class="mt-1 block w-full" />
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Upload Slip</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>