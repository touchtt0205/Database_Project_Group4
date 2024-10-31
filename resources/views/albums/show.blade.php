<!-- resources/views/albums/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $album->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-400 " >
                    <div class="font-semibold text-md mb-2 flex justify-between ">
                        Description :
                        @if(!empty($album->description))
                        {{ $album->description }}
                        @else
                        {{ __('No description ') }}
                        @endif
                        <a href="{{ route('profile.show', Auth::user()->id) }}" class="flex gap-2 text-[16px] font-normal tracking-wide px-4 py-1 inline-block mb-3  bg-red-500 text-white rounded hover:bg-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="currentColor" class="size-3 mt-2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
</svg>

 Back to Profile
                        </a>
                    </div>
                    @if($images->isEmpty())
                    <p>{{ __('No images found in this album.') }}</p>
                    @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($images as $image)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->title }}"
                                class="w-full h-[300px] object-cover">
                            <div class="p-4">
                                <h4 class="text-gray-800 text-lg font-semibold text-md ">{{ $image->title }}</h4>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
