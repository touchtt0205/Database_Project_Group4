<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Image Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold">{{ $image->title }}</h3>
                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->title }}" class="mt-4 mb-4">
                    <p><strong>Description:</strong> {{ $image->description }}</p>
                    <p><strong>Price:</strong> ${{ $image->price }}</p>
                    <p><strong>Max Sales:</strong>
                        @if ($image->max_sales === null)
                        Unlimited
                        @elseif ($image->max_sales > 0)
                        {{ $image->max_sales }} left
                        @else
                        Sold out
                        @endif
                    </p>
                    <div class="mt-4">
                        <span class="text-gray-600">Uploaded by:</span>
                        @if ($image->user)
                        <a href="{{ route('profile.show', $image->user->id) }}" class="text-blue-500 hover:underline">
                            {{ $image->user->name }}
                        </a>
                        @else
                        <span class="text-gray-500">Unknown User</span>
                        @endif
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('images.index') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Back to Images
                        </a>
                    </div>

                    <div class="mt-4">
                        {{-- ตรวจสอบว่าผู้ใช้ซื้อภาพแล้วหรือยัง --}}
                        @if ($hasPurchased)
                        {{-- หากผู้ใช้ซื้อภาพแล้ว ให้แสดงปุ่มดาวน์โหลด --}}
                        <a href="{{ route('images.download', $image->id) }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Download Image
                        </a>
                        @else
                        {{-- หากผู้ใช้ยังไม่ได้ซื้อ ตรวจสอบ max_sales --}}
                        @if ($image->max_sales !== 0)
                        {{-- หากภาพยังขายได้ และผู้ใช้ยังไม่ได้ซื้อ --}}
                        @if ($image->price > 0)
                        <form action="{{ route('images.buy', $image->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Buy Image for ${{ $image->price }}
                            </button>
                        </form>
                        @else
                        {{-- หากภาพนี้ฟรี --}}
                        <a href="{{ route('images.download', $image->id) }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Download Image (Free)
                        </a>
                        @endif
                        @else
                        {{-- หาก max_sales เป็น 0 และผู้ใช้ยังไม่ได้ซื้อภาพนี้ --}}
                        <p class="text-red-500 font-bold">This image is no longer available for sale or download.</p>
                        @endif
                        @endif
                    </div>

                    <div class="mt-4">
                        <form
                            action="{{ $image->isLikedBy(auth()->user()) ? route('images.unlike', $image->id) : route('images.like', $image->id) }}"
                            method="POST">
                            @csrf
                            @if ($image->isLikedBy(auth()->user()))
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Unlike
                            </button>
                            @else
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Like
                            </button>
                            @endif
                        </form>
                        <p class="mt-2 text-gray-600">{{ $image->likes()->count() }} Like(s)</p>
                    </div>


                    <!-- ฟอร์มสำหรับเพิ่มความคิดเห็น -->
                    <div class="mt-8">
                        <h4 class="text-lg font-semibold">Add a Comment</h4>
                        <form method="POST" action="{{ route('comments.store', $image->id) }}">
                            @csrf
                            <div class="mb-4">
                                <textarea name="content" rows="3" class="w-full rounded border-gray-300"
                                    placeholder="Write your comment here..."></textarea>
                            </div>
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Submit
                            </button>
                        </form>
                    </div>

                    <!-- แสดงรายการความคิดเห็น -->
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
                                <p>Comment ID: {{ $comment->comment_id }}</p>
                                <!-- Check if this outputs the correct ID -->
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    Delete
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
</x-app-layout>