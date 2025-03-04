<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTYT X</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #1F2937;
        color: #333;
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav x-data="{ open: false, dropdownOpen: false }" class="bg-gray-900  text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex justify-between">
                    <div class="shrink-0 flex items-center">
                        <img src="{{ asset('storage/images/LogoX.png') }}" style="filter:invert(100%)" alt="Logo"
                            class="block h-9 w-auto">
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex ml-5">
                        <!-- Gallery Button for Refresh -->
                        <button @click="location.reload()"
                            class="text-gray-100 hover:text-gray-300 dark:hover:text-gray-400 focus:outline-none">
                            {{ __('Gallery') }}
                        </button>
                    </div>

                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <div class="flex items-center ">
                        @if (Auth::check())
                        <span class="text-gray-100">{{ Auth::user()->name }}</span>
                        @else
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="text-gray-100  focus:outline-none">
                                guest
                                <svg class="fill-current h-4 w-4 inline-block ml-1" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20">
                                <x-dropdown-link :href="route('login')" :active="request()->routeIs('login')">
                                    {{ __('Login') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('register')" :active="request()->routeIs('register')">
                                    {{ __('Register') }}
                                </x-dropdown-link>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
    </nav>

    <div :class="{'block': open, 'hidden': ! open}" class=" hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 ml-5">
            <x-responsive-nav-link :href="route('images.index')" :active="request()->routeIs('images.index')">
                {{ __('Gallery') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                {{ __('Login') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                {{ __('Register') }}
            </x-responsive-nav-link>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <!-- Changed mt-6 to mt-4 for reduced spacing -->

        <div class="flex gap-4 items-center justify-center">
            <div class="flex  items-center justify-center">
                <div class="font-normal flex justify-center mb-5 welcome-text ">W</div>
                <div class="font-normal flex justify-center mb-5 welcome-text ">E </div>
                <div class="font-normal flex justify-center mb-5 welcome-text ">L</div>
                <div class="font-normal flex justify-center mb-5 welcome-text ">C</div>
                <div class="font-normal flex justify-center mb-5 welcome-text ">O</div>
                <div class="font-normal flex justify-center mb-5 welcome-text ">M</div>
                <div class="font-normal flex justify-center mb-5 welcome-text ">E</div>
            </div>

            <div class="flex items-center justify-center">
                <div class="font-normal flex justify-center mb-5 welcome-text ">T</div>
                <div class="font-normal flex justify-center mb-5 welcome-text ">O</div>
            </div>

            <div class="flex gap-1 items-center justify-center">
                <div class="font-normal flex justify-center mb-5 welcome-textPTYT ">P</div>
                <div class="font-normal flex justify-center mb-5 welcome-textPTYT ">T</div>
                <div class="font-normal flex justify-center mb-5 welcome-textPTYT ">Y</div>
                <div class="font-normal flex justify-center mb-5 welcome-textPTYT ">T</div>
            </div>
        </div>
        <style>
        .welcome-text {
            font-size: 3vw;
            /* Responsive font size */
            background: linear-gradient(90deg, #ffffff, #f2f2f2, #9a9a9a);
            /* Dark to light blue */
            -webkit-background-clip: text;
            color: transparent;
            transition: 0.3s;
            animation: slideIn 1s ease-out;
        }

        .welcome-text:hover {
            scale: 1.3;
        }

        .welcome-textPTYT {

            font-size: 3vw;
            /* Responsive font size */
            background: linear-gradient(90deg, #ffffff, #f2f2f2, #9a9a9a);
            /* Dark to light blue */
            -webkit-background-clip: text;
            color: transparent;
            transition: 0.3s;
            animation: slideIn 1s ease-out;
        }

        .welcome-textPTYT:hover {
            scale: 1.3;
        }

        .bo {
            border: none;
            /* Remove default border */
            height: 1.5px;
            /* Set height of the line */
            background: linear-gradient(90deg, #ffffff, #f2f2f2, #9a9a9a);
            /* Apply gradient */
            border-radius: 2px;
            /* Optional: rounded edges */
        }

        .picshow {
            height: 300px !important;
        }

        .popup {
            border: 3px solid white;
            transition: 0.3s;
        }

        .popup:hover {
            scale: 1.05;
            transition: 0.3s;
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        </style>


        <hr class="bo">
        </hr>

        <div class=" mt-5 mb-12">
            <div class="p-1 text-gray-100">



                <h3 class="font-medium tracking-wide text-lg mb-4">Available Images</h3> <!-- Added mb-2 for spacing -->

                @if ($images->isEmpty())
                <p class="text-gray-500 items-center justify-center">Not Available Image</p>
                @else
                <div class="flex items-center justify-center ">
                    <div class=" max-w-7xl w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($images as $image)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-4 popup">

                            <!-- Added mb-4 for spacing -->
                            @if ($image->path)
                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->name }}"
                                class="picshow w-full h-[300px]  object-cover mb-2">
                            @else
                            <img src="https://via.placeholder.com/400x300?text=No+Image" alt="No Image"
                                class=" picshow w-full h-[300px] object-cover mb-2">
                            @endif
                            <div class="p-4">
                                <h2 class="text-lg font-semibold text-gray-800">{{ $image->title }}</h2>
                                <p class="text-gray-600 dark:text-gray-500 ">{{ $image->description }}</p>
                                <p class="text-gray-400 font-normal mt-3">ราคา: {{ number_format($image->price, 2) }}
                                    บาท</p>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>