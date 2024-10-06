<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    @if(Auth::user()->isAdmin)
                    <a href="{{ route('admin.dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                    @else
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <img src="{{ asset('storage/images/Logodata.png') }}" alt="Logo" class="block h-14 w-auto">
                    </x-nav-link>
                    @endif
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-4 sm:flex">
                    <!-- Dashboard Link -->
                    @if(Auth::user()->isAdmin)
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @else
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @endif
                    <x-nav-link :href="route('images.create')" :active="request()->routeIs('images.create')">
                        {{ __('Upload Image') }}
                    </x-nav-link>
                    <x-nav-link :href="route('images.index')" :active="request()->routeIs('images.index')">
                        {{ __('Show Images') }}
                    </x-nav-link>

                    <!-- Coins Icon with Count -->
                    <x-nav-link :href="route('coins.index')" :active="request()->routeIs('coins.index')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        <span class="text-gray-800 dark:text-gray-200 text-sm font-bold ml-2 mt-1">
                            {{ Auth::user()->coins }}
                        </span>
                    </x-nav-link>

                    <!-- Cart Icon -->
                    <x-nav-link :href="route('cart.show')" :active="request()->routeIs('cart.show')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 hover:text-gray-700"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.6 2.3m1.6 6.7H17.4l1.3-5.7H8.6M16 17c0 1.1-.9 2-2 2s-2-.9-2-2s.9-2 2-2s2 .9 2 2zm-6 0c0 1.1-.9 2-2 2s-2-.9-2-2s.9-2 2-2s2 .9 2 2z" />
                        </svg>
                    </x-nav-link>
                    <!-- Favorite Icon as Star -->
                    <x-nav-link :href="route('favorites.index')" :active="request()->routeIs('favorites.index')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 hover:text-gray-700"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 17.27L18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27z" />
                        </svg>
                    </x-nav-link>

                    <!-- Join Membership Button -->
                    <x-nav-link :href="route('memberships.index')" :active="request()->routeIs('membership.index')">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.7874 3.03525C11.547 3.39205 11.2727 3.95013 10.861 4.79379L8.60836 9.40976C8.40969 9.81692 8.23706 10.1707 8.07192 10.4395C7.90282 10.7147 7.67982 11.0082 7.33245 11.183C7.01901 11.3408 6.66586 11.3987 6.31634 11.3435C5.92305 11.2813 5.62461 11.0579 5.39095 10.8419C5.16444 10.6325 4.9109 10.3438 4.62331 10.0164L4.59843 9.98804C3.9896 9.29494 3.57063 8.81934 3.24613 8.51599C3.08554 8.36587 2.97998 8.28889 2.9151 8.25262C2.9148 8.25246 2.91451 8.25229 2.91421 8.25213C2.88044 8.26445 2.84123 8.28885 2.80252 8.33352C2.80247 8.33349 2.8026 8.33347 2.80252 8.33352C2.8051 8.33487 2.74659 8.45377 2.75021 8.91937C2.754 9.40668 2.81715 10.0849 2.90854 11.056L3.13774 13.4913C3.32823 15.5153 3.46628 16.9699 3.69773 18.0729C3.92652 19.1632 4.22785 19.8071 4.67644 20.266C5.114 20.7136 5.67605 20.9697 6.61279 21.1067C7.5801 21.2481 8.84501 21.25 10.6401 21.25H13.36C15.1551 21.25 16.42 21.2481 17.3873 21.1067C18.324 20.9697 18.8861 20.7136 19.3236 20.266C19.7722 19.8071 20.0735 19.1632 20.3023 18.0729C20.5338 16.9699 20.6718 15.5153 20.8623 13.4913L21.0915 11.056C21.1829 10.0849 21.2461 9.40668 21.2499 8.91937C21.2535 8.45377 21.1948 8.33484 21.1974 8.33349C21.1978 8.33328 21.1996 8.33582 21.2033 8.34028C21.1627 8.29129 21.1213 8.26506 21.0859 8.25213C21.0856 8.25229 21.0853 8.25246 21.085 8.25262C21.0201 8.28889 20.9145 8.36587 20.7539 8.51599C20.4294 8.81934 20.0105 9.29494 19.4016 9.98804L19.3768 10.0164C19.0892 10.3438 18.8356 10.6325 18.6091 10.8419C18.3755 11.0579 18.077 11.2813 17.6837 11.3435C17.3342 11.3987 16.9811 11.3408 16.6676 11.183C16.3203 11.0082 16.0972 10.7147 15.9281 10.4395C15.763 10.1707 15.5904 9.81688 15.3917 9.40969L13.1391 4.79378C12.7274 3.95013 12.453 3.39205 12.2127 3.03525C12.1109 2.88414 12.0409 2.80859 12 2.7722C11.9592 2.80859 11.8892 2.88414 11.7874 3.03525ZM12.0441 2.74096C12.0441 2.74143 12.0409 2.74333 12.0348 2.74527C12.0411 2.74146 12.0441 2.74049 12.0441 2.74096ZM11.9652 2.74527C11.9591 2.74333 11.956 2.74143 11.956 2.74096C11.9559 2.74049 11.959 2.74146 11.9652 2.74527ZM10.5434 2.19718C10.8451 1.74936 11.2937 1.25 12 1.25C12.7064 1.25 13.155 1.74935 13.4567 2.19717C13.7629 2.65167 14.0824 3.30648 14.4612 4.08282L16.724 8.71958C16.943 9.16842 17.0839 9.45523 17.2062 9.65422C17.291 9.79232 17.3374 9.83677 17.3483 9.8462C17.3795 9.86072 17.4086 9.86537 17.4355 9.86347C17.4528 9.85385 17.5014 9.82316 17.5908 9.74055C17.7529 9.59068 17.9547 9.36242 18.2747 8.9981L18.3038 8.96498C18.8765 8.313 19.3443 7.78043 19.7296 7.42022C19.9272 7.23552 20.1348 7.0653 20.3531 6.9433C20.575 6.81924 20.8537 6.71955 21.1717 6.74748C21.6447 6.78903 22.0645 7.02828 22.3588 7.38387C22.7139 7.81286 22.7538 8.41259 22.7498 8.93104C22.7455 9.49109 22.6755 10.2344 22.5886 11.158L22.3512 13.6798C22.1662 15.6455 22.0213 17.185 21.7704 18.381C21.5147 19.5995 21.1303 20.5636 20.3963 21.3145C19.6512 22.0767 18.7357 22.4254 17.6043 22.5909C16.516 22.75 15.1414 22.75 13.4194 22.75H10.5807C8.8587 22.75 7.48403 22.75 6.39573 22.5909C5.26436 22.4254 4.34888 22.0767 3.60382 21.3145C2.86979 20.5636 2.4854 19.5995 2.22971 18.381C1.97873 17.185 1.83384 15.6455 1.64885 13.6798L1.41151 11.158C1.32458 10.2344 1.25461 9.4911 1.25026 8.93104C1.24622 8.41259 1.28618 7.81286 1.64125 7.38387C1.93556 7.02828 2.35533 6.78903 2.8284 6.74748C3.14638 6.71955 3.42506 6.81924 3.64699 6.9433C3.86525 7.0653 4.07291 7.23552 4.27048 7.42022C4.65579 7.78042 5.12359 8.31299 5.69628 8.96497L5.72538 8.9981C6.04541 9.36242 6.24721 9.59068 6.40929 9.74055C6.49864 9.82316 6.54723 9.85385 6.56457 9.86347C6.59142 9.86537 6.62056 9.86072 6.65181 9.8462C6.66267 9.83677 6.70903 9.79233 6.79388 9.65422C6.91614 9.45523 7.05705 9.16843 7.27608 8.71959L9.53885 4.08284C9.91767 3.30649 10.2372 2.65167 10.5434 2.19718Z"
                                    fill="#292929"></path>
                            </g>
                        </svg>

                        {{ __('Join Membership') }}
                    </x-nav-link>


                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">

                            <!-- Profile Photo -->
                            <div class="flex items-center">
                                @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo"
                                    class="h-8 w-8 rounded-full border-2 border-gray-300 shadow-lg mr-2">
                                @else
                                <div class="h-8 w-8 bg-gray-300 rounded-full border-2 border-gray-300 shadow-lg mr-2">
                                </div> <!-- Placeholder if no photo -->
                                @endif
                            </div>

                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.show', Auth::user()->id)">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->isAdmin)
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @else
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('images.create')" :active="request()->routeIs('images.create')">
                {{ __('Upload Image') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('images.index')" :active="request()->routeIs('images.index')">
                {{ __('Show Images') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('coins.index')" :active="request()->routeIs('coins.index')">
                {{ __('Coins') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('cart.show')" :active="request()->routeIs('cart.show')">
                {{ __('Cart') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('favorites.index')" :active="request()->routeIs('favorites.index')">
                {{ __('Favorites') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <!-- <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div> -->
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.show', Auth::user()->id)">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

</nav>