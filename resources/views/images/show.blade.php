<x-app-layout>
    <x-slot name="header">
        <h2 class=" font-normal tracking-wide text-[26px] text-gray-200 leading-tight text-center">
            {{ __('Image Details') }}
        </h2>


        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 text-gray-100">
                    <hr></hr>
                        <div class=" mt-3 flex justify-center w-full  min-w-[500px]">

                            <div class="flex justify-end">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->title }}"
                                class="mt-4 mb-4 relative  min-w-[1100px]">

                                <div class="mt-5 absolute">
                                    <a href="{{ route('images.index') }}"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        X
                                    </a>
                                </div>
                            </div>


                            {{-- Check if the image is purchased or free --}}
                            @if (!$hasPurchased && $image->price > 0)
                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                <span class="text-white text-3xl font-bold opacity-50 z-20 watermark-text">PTYT PTYT
                                    PTYT </span>
                            </div>
                            @endif
                        </div>


                        <div class="flex justify-between " >
                            <h3 class="text-[26px] font-bold  tracking-wide">{{ $image->title }}</h3>

                            <div class="flex justify-between" >

                            <div class= " flex mr-5 mt-2" >
                                <form
                                    action="{{ $image->isLikedBy(auth()->user()) ? route('images.unlike', $image->id) : route('images.like', $image->id) }}"
                                    method="POST">
                                    @csrf
                                    @if ($image->isLikedBy(auth()->user()))
                                    @method('DELETE')
                                    <button type="submit"
                                        class= "text-red font-bold py-2 px-2 rounded ">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" class="size-6">
  <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
</svg>

                                    </button>
                                    @else
                                    <button type="submit"
                                        class= "text-red font-bold py-2 px-2 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
</svg>

                                    </button>
                                    @endif
                                </form>
                                <p class="mt-2 text-gray-400 tracking-wide">{{ $image->likes()->count()}} Like(s)</p>
                            </div>
                            <div class="relative mt-2">


                                {{-- Check if the user has purchased the image --}}
                                @if ($hasPurchased)
                                {{-- If the user has purchased the image, show the download button --}}
                                <a href="{{ route('images.download', $image->id) }}"
                                    class= "tracking-wide flex gap-3 bg-green-500 hover:bg-green-700 text-white font-normal py-2 px-4 rounded">
                                    Download Image <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
</svg>

                                </a>
                                @else
                                {{-- If the user has not purchased, check max_sales --}}
                                @if ($image->max_sales !== 0)
                                {{-- If the image is still for sale and the user has not purchased --}}
                                @if ($image->price > 0)
                                <form action="{{ route('images.buy', $image->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="font-normal flex gap-3 tracking-wide bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                                        Buy Image for ${{ $image->price }}
                                    </button>
                                </form>
                                @else
                                {{-- If the image is free --}}
                                <a href="{{ route('images.download', $image->id) }}"
                                    class=" tracking-wide flex gap-3 bg-green-500 hover:bg-green-700 text-white font-normal py-2 px-4 rounded">
                                    Download Image (Free) <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
</svg>

                                </a>
                                @endif
                                @else
                                {{-- If max_sales is 0 and the user has not purchased the image --}}
                                <p class="tracking-wide text-red-500 font-normal">This image is no longer available for sale or download.
                                </p>
                                @endif
                                @endif
                            </div>


                            </div>
                        </div>


                        <p class="font-normal tracking-wide">Description : {{ $image->description }}</p>
                        <p class="font-normal tracking-wide">Price : ${{ $image->price }}</p>
                        <p class="font-normal tracking-wide">Max Sales :
                            @if ($image->max_sales === null)
                            Unlimited
                            @elseif ($image->max_sales > 0)
                            {{ $image->max_sales }} left
                            @else
                            Sold out
                            @endif
                        </p>
                        <div class="mt-4">
                            <span class="text-gray-400 tracking-wide">Uploaded by : </span>
                            @if ($image->user)
                            <a href="{{ route('profile.show', $image->user->id) }}"
                                class="text-blue-400 hover:underline">
                                {{ $image->user->name }}
                            </a>
                            @else
                            <span class="text-gray-500">Unknown User</span>
                            @endif
                        </div>



                        <div class="mt-4 tracking-wide">
                            <hr></hr>
                            <h4 class="mt-3 flex gap-2 text-lg font-bold"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 mt-1">
  <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z" clip-rule="evenodd" />
</svg>
Tags</h4>
                            @if ($image->tags->count() > 0)
                            <ul class="list-disc pl-5 text-gray-400">
                                @foreach ($image->tags as $photoTag)
                                <li>{{ $photoTag->tag->name }}</li> {{-- Assuming the Tag model has a 'name' field --}}
                                @endforeach
                            </ul>
                            @else
                            <p class="text-gray-400">No tags available for this image.</p>
                            @endif
                        </div>

                        <!-- Form for adding comments -->
                        <div class="mt-8 tracking-wide">
                            <h4 class="flex gap-2 text-lg font-bold mb-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 mt-1">
  <path fill-rule="evenodd" d="M4.848 2.771A49.144 49.144 0 0 1 12 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 0 1-3.476.383.39.39 0 0 0-.297.17l-2.755 4.133a.75.75 0 0 1-1.248 0l-2.755-4.133a.39.39 0 0 0-.297-.17 48.9 48.9 0 0 1-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97ZM6.75 8.25a.75.75 0 0 1 .75-.75h9a.75.75 0 0 1 0 1.5h-9a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H7.5Z" clip-rule="evenodd" />
</svg>
 Add a Comment</h4>
                            <form method="POST" action="{{ route('comments.store', $image->id) }}">
                                @csrf
                                <div class="mb-3">
                                    <textarea name="content" rows="3" class="min-h-[40px] w-full rounded border-gray-300 text-gray-500 text-normal"
                                        placeholder="Write your comment here..."></textarea>
                                </div>
                                <button type="submit"
                                    class=  " bg-blue-500 hover:bg-blue-700 text-white font-normal py-2 px-4 rounded">
                                    Submit
                                </button>
                            </form>
                        </div>

                        <!-- Show comments list -->
                        <div class="mt-8">
                            <h4 class="text-lg font-semibold">Comments</h4>
                            @if ($image->comments->count() > 0)
                            @foreach ($image->comments as $comment)
                            <div class="mt-4 p-4 bg-gray-100 dark:bg-gray-700 rounded">
                                <p>{{ $comment->content }}</p>
                                <span class="text-sm text-gray-500">- {{ $comment->user->name }},
                                    {{ $comment->created_at->diffForHumans() }}</span>
                                @if ($comment->user_id === auth()->id())
                                <!-- Check if the authenticated user is the owner -->
                                <form method="POST" action="{{ route('comments.destroy', $comment->comment_id) }}"
                                    class="inline-block">

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class=" ml-2 flex gap-1 text-red-500 hover:text-red-700">
                                         Delete <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mt-1">
  <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
</svg>

                                    </button>
                                </form>
                                @endif
                            </div>
                            @endforeach
                            @else
                            <p class="text-gray-500">No comments yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <style>
        .watermark-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            /* Center the text */
            pointer-events: none;
            /* Prevent clicks on the watermark text */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
            /* Optional: Add a shadow for better visibility */
        }
    </style>

    <script>
        document.addEventListener('contextmenu', function(e) {
            if (e.target.tagName === 'IMG') {
                e.preventDefault();
            }
        });
    </script>

</x-app-layout>
