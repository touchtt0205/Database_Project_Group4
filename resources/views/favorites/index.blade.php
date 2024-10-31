<x-app-layout>
    <x-slot name="header">
        <h2 class="font-normal tracking-wide text-[26px] text-gray-200 leading-tight text-center mb-4">
            {{ __('Favorite Images') }}
        </h2>
        <hr></hr>

        <div class="py-1 min-h-[550px]">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-100">

                        <!-- แสดงข้อความถ้าไม่มีรูปภาพที่ Favorite -->
                        @if($favorites->isEmpty())
                        <p>No favorite images found.</p>
                        @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($favorites as $favorite)
                            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white ">
                                <a href="{{ route('images.show', $favorite->image->id) }}">
                                    <img class="w-full h-[300px] object-cover" src="{{ asset('storage/' . $favorite->image->path) }}"
                                        alt="{{ $favorite->image->title }}">
                                    <div class="px-4 py-4">
                                        <div class="font-bold text-xl text-gray-800">{{ $favorite->image->title }}</div>
                                        <p class="text-gray-500 text-base">
                                            {{ Str::limit($favorite->image->description, 100) }}
                                        </p>
                                    </div>
                                </a>
                                <div class="px-6 py-3">
                                    <form action="{{ route('favorites.destroy', $favorite->image->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type=" submit" class="mb-3 flex gap-2 bg-red-500 hover:bg-red-700 py-2 px-4 rounded-lg float-right" >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM20.25 5.507v11.561L5.853 2.671c.15-.043.306-.075.467-.094a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93ZM3.75 21V6.932l14.063 14.063L12 18.088l-7.165 3.583A.75.75 0 0 1 3.75 21Z" />
</svg>

 Unfavorite
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        @endif

                        <!-- Flash message -->
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
    </x-slot>


</x-app-layout>
