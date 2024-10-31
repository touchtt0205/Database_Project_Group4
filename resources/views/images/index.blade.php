<x-app-layout>
    <x-slot name="header">
        <h2 class="font-normal tracking-wide text-[26px] text-gray-200 leading-tight text-center">
            {{ __('Gallery') }}
        </h2>
        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg min-h-[550px]">
                    <div class="p-6 text-gray-100 ">
                        <div class="flex justify-between">
                            <div>
                                <!-- Tag Filter -->
                                @if(isset($tags) && !empty($tags))
                                <h3 class="font-normal text-lg tracking-wide mb-3">Filter by Tag :</h3>

                                <div class="flex flex-wrap mb-3 gap-2">

                                    @foreach ($tags as $tag)

                                    <a href="{{ route('images.filterByTag', $tag->name) }}"
                                        class="tag-filter py-2 px-4 rounded border-2 border-gray-400 bg-transparent text-gray-700 hover:bg-gray-700 transition duration-300 {{ isset($selectedTag) && $selectedTag === $tag->name ? 'active' : '' }}"
                                        data-tag="{{ $tag->name }}">
                                        {{ $tag->name }}
                                    </a>
                                    @endforeach
                                </div>
                                @endif
                            </div>


                        </div>

                        <div class="flex justify-between items-center mt-1 mb-3">
                            <h3 class="font-normal tracking-wide text-lg">Available Images </h3>

                            <!-- Filter Form -->
                            <div class="flex gap-3 items-center">
                                <form method="GET" action="{{ route('images.index') }}" class="">
                                    <label for="sort" class="mr-2 mb-3 ">Sort by :</label>
                                    <select id="sort" name="sort" class=" text-sm sm:rounded-lg text-gray-600"
                                        onchange="this.form.submit() ">
                                        <option class="sortHover" value="latest"
                                            {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest
                                            Uploaded
                                        </option>
                                        <option class="sortHover" value="oldest"
                                            {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest
                                            Uploaded
                                        </option>
                                        <option class="sortHover" value="price_asc"
                                            {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price:
                                            Low
                                            to High</option>
                                        <option class="sortHover" value="price_desc"
                                            {{ request('sort') === 'price_desc' ? 'selected' : '' }}>
                                            Price:
                                            High to Low</option>
                                    </select>
                                </form>
                                <a href="{{ route('images.index') }}"
                                    class=" border-2 border-red-500 hover:text-white hover:bg-red-700 item-center flex justify-center rounded text-gray-100  bg-red-500 px-4 py-[5px] gap-1">Reset
                                    Filter <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9.75 14.25 12m0 0 2.25 2.25M14.25 12l2.25-2.25M14.25 12 12 14.25m-2.58 4.92-6.374-6.375a1.125 1.125 0 0 1 0-1.59L9.42 4.83c.21-.211.497-.33.795-.33H19.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-9.284c-.298 0-.585-.119-.795-.33Z" />
                                    </svg>
                                </a>
                            </div>

                        </div>
                        <hr>
                        <hr>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
                            @foreach ($images as $image)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <!-- รูป -->
                                <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->title }}"
                                    class="w-full h-auto object-contain mb-2">
                                <!-- ข้อมูลรูป -->
                                <div class="p-4">
                                    <h4 class="font-semibold text-lg text-gray-800 ">{{ $image->title }}</h4>
                                    <p class="text-gray-500">Price : $ {{ $image->price }}</p>
                                    <div class="mt-2 flex justify-between items-center">
                                        <!-- Eye Icon for View Details -->
                                        <a href="{{ route('images.show', $image->id) }}"
                                            class="text-gray-500 hover:text-blue-500" title="View Details">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.5C6.75 4.5 3 12 3 12s3.75 7.5 9 7.5 9-7.5 9-7.5-3.75-7.5-9-7.5zM12 8.25a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5z" />
                                            </svg>
                                        </a>

                                        <div class="flex items-center">
                                            @if(Auth::user()->favorites()->where('image_id', $image->id)->exists())
                                            <form action="{{ route('favorites.destroy', $image->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-700 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M10 15.273l-4.79 2.52 1.027-5.977L1 6.691l5.978-.868L10 1l2.022 4.823 5.978.868-3.238 3.123 1.027 5.977L10 15.273z" />
                                                    </svg>
                                                    Unfavorite
                                                </button>
                                            </form>
                                            @else
                                            <form action="{{ route('favorites.store', $image->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                <button type="submit"
                                                    class="text-yellow-500 hover:text-yellow-600 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M10 15.273l-4.79 2.52 1.027-5.977L1 6.691l5.978-.868L10 1l2.022 4.823 5.978.868-3.238 3.123 1.027 5.977L10 15.273z" />
                                                    </svg>
                                                    Favorite
                                                </button>
                                            </form>
                                            @endif
                                        </div>

                                        <div id="toast-container" class="fixed top-0 right-0 p-6 z-50">
                                            @if (session('success'))
                                            <script>
                                                showToast("{{ session('success') }}", 'success');
                                            </script>
                                            @endif

                                            @if (session('error'))
                                            <script>
                                                showToast("{{ session('error') }}", 'error');
                                            </script>
                                            @endif
                                        </div>



                                        @if (Auth::check())
                                        @php
                                        // Check if the user owns the image
                                        $ownershipExists = \App\Models\ImageOwnership::where('user_id', Auth::id())
                                        ->where('image_id', $image->id)
                                        ->exists();

                                        // Check if the user has the image in the cart
                                        $cartExists = \App\Models\Cart::where('user_id', Auth::id())
                                        ->where('image_id', $image->id)
                                        ->exists();
                                        @endphp

                                        @if (Auth::user()->id === $image->user_id)
                                        <!-- User's own image -->
                                        <button type="button" class="add-to-cart text-gray-500 hover:text-blue-500"
                                            disabled title="You cannot add your own image to the cart.">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6 text-gray-500 hover:text-gray-700" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.6 2.3m1.6 6.7H17.4l1.3-5.7H8.6M16 17c0 1.1-.9 2-2 2s-2-.9-2-2s.9-2 2-2s2 .9 2 2zm-6 0c0 1.1-.9 2-2 2s-2-.9-2-2s.9-2 2-2s2 .9 2 2z" />
                                                <line x1="2" y1="2" x2="22" y2="22" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" />
                                            </svg>
                                        </button>
                                        @else
                                        <form action="{{ route('carts.add', $image->id) }}" method="POST"
                                            class="add-to-cart-form">
                                            @csrf
                                            <button type="submit" class="add-to-cart text-gray-500 hover:text-blue-500"
                                                data-owner="{{ Auth::user()->id === $image->user_id ? 'true' : 'false' }}"
                                                data-ownership="{{ $ownershipExists ? 'true' : 'false' }}"
                                                data-cart="{{ $cartExists ? 'true' : 'false' }}" title="Add to Cart">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-6 w-6 text-gray-500 hover:text-gray-700" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 3h2l.6 2.3m1.6 6.7H17.4l1.3-5.7H8.6M16 17c0 1.1-.9 2-2 2s-2-.9-2-2s.9-2 2-2s2 .9 2 2zm-6 0c0 1.1-.9 2-2 2s-2-.9-2-2s.9-2 2-2s2 .9 2 2z" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- No Images Message -->
                        @if ($images->isEmpty())
                        <p class="text-gray-500 font-normal">{{ __('No images available.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <style>
            #option.sortHover:hover {
                background-color: red;
            }

            .tag-filter {
                background-color: transparent;
                /* Transparent background */
                border: 2px solid gray;
                color: gray;
                /* Dashed gray border */
                transition: background-color 0.3s ease, border-color 0.3s ease;
                /* Smooth transition */
            }

            .tag-filter:hover {
                background-color: rgba(0, 0, 0, 0.1);
                /* Slightly dark background on hover */
                border-color: white;
                color: white;
                /* Keep border color gray on hover */
            }

            .tag-filter.active {
                background-color: white;
                /* Solid gray background when selected */
                border-color: white;
                color: black;
                /* Text color white when selected */
            }

            .toast {
                visibility: hidden;
                min-width: 250px;
                margin: 5px;
                background-color: #FF0000;
                /* สีแดงเริ่มต้นสำหรับการแจ้งเตือน */
                color: #FFF;
                text-align: center;
                border-radius: 5px;
                padding: 16px;
                position: relative;
                z-index: 1;
                transition: visibility 0.5s, opacity 0.5s linear;
                opacity: 0;
            }

            .toast.show {
                visibility: visible;
                opacity: 1;
                transition: visibility 0.5s, opacity 0.5s linear;
            }

            .toast.success {
                background-color: #28a745;
                /* สีเขียวสำหรับการแจ้งเตือนสำเร็จ */
            }

            .toast.error {
                background-color: #dc3545;
                /* สีแดงสำหรับการแจ้งเตือนข้อผิดพลาด */
            }
        </style>

        <script>
            function hideToast(toastId) {
                const toast = document.getElementById(toastId);
                if (toast) {
                    setTimeout(() => {
                        toast.style.display = 'none'; // ซ่อนการแจ้งเตือน
                    }, 3000); // ปรับเวลาได้ตามต้องการ (3000 ms = 3 วินาที)
                }
            }

            function showToast(message, type = 'success') {
                const toastContainer = document.getElementById('toast-container');
                const toast = document.createElement('div');

                // กำหนดสีพื้นหลังของ toast ตามประเภท
                toast.className = `toast show ${type === 'error' ? 'error' : 'success'}`; // ใช้คลาส error หรือ success
                toast.innerText = message;

                toastContainer.appendChild(toast);

                // ลบ toast หลังจาก 3 วินาที
                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => {
                        toastContainer.removeChild(toast);
                    }, 500); // รอการเปลี่ยนภาพ fade-out
                }, 3000);
            }



            document.addEventListener('DOMContentLoaded', () => {
                const urlParams = new URLSearchParams(window.location.search);
                const selectedTag = urlParams.get('tag'); // Get the tag from the URL

                const tags = document.querySelectorAll('.tag-filter');

                if (selectedTag) {
                    const activeTag = document.querySelector(`.tag-filter[data-tag="${selectedTag}"]`);
                    if (activeTag) {
                        activeTag.classList.add('active'); // Add active class to selected tag
                    }
                }

                tags.forEach(tag => {
                    tag.addEventListener('click', function(e) {
                        e.preventDefault(); // Prevent default link behavior

                        // If the clicked tag is already active, clear the selection
                        if (this.classList.contains('active')) {
                            // Redirect to the index route without any filter
                            window.location.href = "{{ route('images.index') }}";
                        } else {
                            // Remove active class from all tags
                            tags.forEach(t => t.classList.remove('active'));
                            // Add active class to clicked tag
                            this.classList.add('active');
                            // Navigate to the clicked tag's link
                            window.location.href = this.href;
                        }
                    });
                });

                document.querySelectorAll('.add-to-cart-form').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        const isOwner = this.querySelector('.add-to-cart').dataset.owner === 'true';
                        const isOwned = this.querySelector('.add-to-cart').dataset.ownership ===
                            'true';
                        const isInCart = this.querySelector('.add-to-cart').dataset.cart === 'true';

                        if (isOwner) {
                            e.preventDefault(); // Prevent form submission
                            showToast('You cannot add your own image to the cart.',
                                'error'); // Show error toast
                        } else if (isOwned) {
                            e.preventDefault(); // Prevent form submission
                            showToast('You already own this image.', 'error'); // Show error toast
                        } else if (isInCart) {
                            e.preventDefault(); // Prevent form submission
                            showToast('This image is already in your cart.',
                                'error'); // Show error toast
                        } else {
                            // If all checks pass, show success toast before the form is submitted
                            showToast('Image added to cart successfully!', 'success');
                            // No need to prevent the form submission, it will proceed normally
                        }
                    });
                });

            });

            hideToast('success-toast');
            hideToast('error-toast');
        </script>

    </x-slot>


</x-app-layout>