<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Album') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('albums.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-100">{{ __('Album Title') }}</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full sm:rounded-lg text-blue-800 placeholder-blue-500 focus:outline-none focus:ring focus:ring-blue-400" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-100">{{ __('Album Description') }}</label>
                            <input type="text" name="description" id="description" class="mt-1 block w-full sm:rounded-lg text-blue-800 placeholder-blue-500 focus:outline-none focus:ring focus:ring-blue-400" required>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Create') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        input:focus {
            color: #1e3a8a;
            outline: none;
        }
    </style>
</x-app-layout>
