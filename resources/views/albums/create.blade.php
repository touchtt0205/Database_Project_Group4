<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-gray-200 text-center">
            {{ __('Create Album') }}
        </h2>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-700 dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form action="{{ route('albums.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="title"
                                    class="block text-sm font-medium text-[#d7d7d7]">{{ __('Album Title') }}</label>
                                <input type="text" name="title" id="title"
                                    class="bg-[#141A24] #141A24mt-1 block w-full sm:rounded-lg text-[#d7d7d7] placeholder-[#d7d7d7] focus:outline-none focus:ring focus:[#d7d7d7]"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label for="description"
                                    class="block text-sm font-medium text-[#d7d7d7]">{{ __('Album Description') }}</label>
                                <input type="text" name="description" id="description"
                                    class="bg-[#141A24] mt-1 block w-full sm:rounded-lg text-[#d7d7d7] placeholder-[#d7d7d7] focus:outline-none focus:ring focus:[#d7d7d7]"
                                    required>
                            </div>

                            <div class="flex justify-end mt-4">
                                <button type="submit"
                                    class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
                color: #d7d7d7;
                outline: none;
            }
        </style>
    </x-slot>


</x-app-layout>