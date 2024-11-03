<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#d7d7d7] dark:text-gray-200 leading-tight text-center">
            {{ __('Manage Tags') }}
        </h2>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-700 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <!-- Display success message -->
                        @if(session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mt-4">
                            {{ session('success') }}
                        </div>
                        @endif

                        <!-- Form to add a new tag -->
                        <form action="{{ route('admin.tags.store') }}" method="POST" class="mb-4">
                            @csrf
                            <input type="text" name="name" placeholder="Tag Name" required class="border rounded p-2">
                            <button type="submit" class="bg-green-500 text-white rounded p-2">Add Tag</button>
                        </form>

                        <!-- List of existing tags -->
                        @if($tags->isEmpty())
                        <p>No tags found.</p>
                        @else
                        <ul>
                            @foreach($tags as $tag)
                            <li class="flex justify-between items-center mb-2 text-[#d7d7d7]">
                                <span>{{ $tag->name }}</span>
                                <form action="{{ route('admin.tags.destroy', $tag->tags_id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-slot>


</x-app-layout>