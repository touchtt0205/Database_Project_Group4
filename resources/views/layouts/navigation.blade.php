<nav x-data="{ open: false }" class="bg-[#3d4d6a] border-b border-[#3d4d6a]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    @if(Auth::user()->isAdmin)
                    <a href="{{ route('admin.dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                    @else
                    <x-nav-link :href="route('images.index')" :active="request()->routeIs('dashboard')">
                        <img src="{{ asset('storage/images/NewLogo.png') }}" alt="Logo" class="block h-6 w-auto">
                    </x-nav-link>
                    @endif
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-4 sm:flex">
                    <!-- Dashboard Link -->
                    @if(Auth::user()->isAdmin)
                    <x-nav-link :href=" route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @endif
                    <x-nav-link :href="route('images.index')" :active="request()->routeIs('images.index')">
                        {{ __('Gallery') }}
                    </x-nav-link>
                    <x-nav-link :href="route('images.create')" :active="request()->routeIs('images.create')">
                        {{ __('Upload') }}
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
                    <div class="mt-3">
                        <input type="text" id="search" placeholder="Search images or users..."
                            class="w-full p-2 border rounded">


                    </div>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Coins Icon with Count -->
                <x-nav-link :href="route('coins.index')" :active="request()->routeIs('coins.index')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                    <span class="text-gray-800 dark:text-gray-200 text-sm font-bold ml-2 mt-1 mb-1">
                        {{ Auth::user()->coins }}
                    </span>
                </x-nav-link>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            @php
                            // ดึงระดับสมาชิกของผู้ใช้
                            $memberLevel = Auth::user()->member_level ?? null;


                            // กำหนดส่วนลดตามระดับสมาชิก
                            if ($memberLevel === "Bronze") {
                            echo '<svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 300.439 300.439"
                                xml:space="preserve" fill="#000000" class="w-ุ6 h-6 mr-3">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <path style="fill:#BF392C;"
                                            d="M276.967,0h-84.498L70.415,178.385h84.498L276.967,0z"></path>
                                        <path style="fill:#E2574C;"
                                            d="M23.472,0h84.498l122.053,178.385h-84.498L23.472,0z"></path>
                                        <path style="fill:#ED9D5D;"
                                            d="M154.914,93.887c57.271,0,103.276,46.005,103.276,103.276s-46.005,103.276-103.276,103.276 S51.638,254.434,51.638,197.163S97.643,93.887,154.914,93.887z">
                                        </path>
                                        <path style="fill:#D58D54;"
                                            d="M154.914,122.053c-41.31,0-75.11,33.799-75.11,75.11s33.799,75.11,75.11,75.11 s75.11-33.799,75.11-75.11S196.224,122.053,154.914,122.053z M154.914,253.495c-30.983,0-56.332-25.35-56.332-56.332 s25.35-56.332,56.332-56.332s56.332,25.35,56.332,56.332S185.896,253.495,154.914,253.495z">
                                        </path>
                                    </g>
                                </g>
                            </svg>';
                            } elseif ($memberLevel === "Silver") {
                            echo '<svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 300.439 300.439"
                                xml:space="preserve" fill="#000000" class="w-ุ6 h-6 mr-3">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <path style="fill:#BF392C;"
                                            d="M276.967,0h-84.498L70.415,178.385h84.498L276.967,0z"></path>
                                        <path style="fill:#E2574C;"
                                            d="M23.472,0h84.498l122.053,178.385h-84.498L23.472,0z"></path>
                                        <path style="fill:#E4E7E7;"
                                            d="M154.914,93.887c57.271,0,103.276,46.005,103.276,103.276s-46.005,103.276-103.276,103.276 S51.638,254.434,51.638,197.163S97.643,93.887,154.914,93.887z">
                                        </path>
                                        <path style="fill:#CDCFCF;"
                                            d="M154.914,122.053c-41.31,0-75.11,33.799-75.11,75.11s33.799,75.11,75.11,75.11 s75.11-33.799,75.11-75.11S196.224,122.053,154.914,122.053z M154.914,253.495c-30.983,0-56.332-25.35-56.332-56.332 s25.35-56.332,56.332-56.332s56.332,25.35,56.332,56.332S185.896,253.495,154.914,253.495z">
                                        </path>
                                    </g>
                                </g>
                            </svg>';
                            } elseif ($memberLevel === "Gold") {
                            echo '<svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                xml:space="preserve" fill="#000000" class="w-6 h-6 mr-3">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <path style="fill:#CA3E49;" d="M61.793,450.207h388.414V344.276H61.793V450.207z">
                                        </path>
                                        <g>
                                            <path style="fill:#9B2432;"
                                                d="M61.793,450.207v-61.793H0l35.31,52.966L0,494.345h79.448v-44.138H61.793z">
                                            </path>
                                            <path style="fill:#9B2432;"
                                                d="M512,388.414h-61.793v61.793h-17.655v44.138H512l-35.31-52.966L512,388.414z">
                                            </path>
                                        </g>
                                        <g>
                                            <path style="fill:#FFFFFF;"
                                                d="M185.379,388.414h-35.31c-4.882,0-8.828-3.946-8.828-8.828s3.946-8.828,8.828-8.828h35.31 c4.882,0,8.828,3.946,8.828,8.828S190.261,388.414,185.379,388.414">
                                            </path>
                                            <path style="fill:#FFFFFF;"
                                                d="M273.655,388.414H220.69c-4.882,0-8.828-3.946-8.828-8.828s3.946-8.828,8.828-8.828h52.966 c4.882,0,8.828,3.946,8.828,8.828S278.537,388.414,273.655,388.414">
                                            </path>
                                            <path style="fill:#FFFFFF;"
                                                d="M229.517,423.724h-79.448c-4.882,0-8.828-3.946-8.828-8.828c0-4.882,3.946-8.828,8.828-8.828 h79.448c4.882,0,8.828,3.946,8.828,8.828C238.345,419.778,234.399,423.724,229.517,423.724">
                                            </path>
                                            <path style="fill:#FFFFFF;"
                                                d="M361.931,423.724h-17.655c-4.882,0-8.828-3.946-8.828-8.828c0-4.882,3.946-8.828,8.828-8.828 h17.655c4.882,0,8.828,3.946,8.828,8.828C370.759,419.778,366.813,423.724,361.931,423.724">
                                            </path>
                                            <path style="fill:#FFFFFF;"
                                                d="M308.966,423.724h-44.138c-4.882,0-8.828-3.946-8.828-8.828c0-4.882,3.946-8.828,8.828-8.828 h44.138c4.882,0,8.828,3.946,8.828,8.828C317.793,419.778,313.847,423.724,308.966,423.724">
                                            </path>
                                            <path style="fill:#FFFFFF;"
                                                d="M361.931,388.414h-44.138c-4.882,0-8.828-3.946-8.828-8.828s3.946-8.828,8.828-8.828h44.138 c4.882,0,8.828,3.946,8.828,8.828S366.813,388.414,361.931,388.414">
                                            </path>
                                        </g>
                                        <path style="fill:#F8D832;"
                                            d="M449.63,344.276c17.24-31.444,27.057-67.54,27.057-105.931c0-121.882-98.807-220.69-220.69-220.69 s-220.69,98.807-220.69,220.69c0,38.391,9.825,74.487,27.065,105.931H449.63z">
                                        </path>
                                        <path style="fill:#C4A316;"
                                            d="M385.896,344.276c23.614-28.901,37.826-65.783,37.826-105.931 c0-92.487-75.238-167.724-167.724-167.724c-92.478,0-167.724,75.238-167.724,167.724c0,40.148,14.212,77.03,37.826,105.931H385.896 z">
                                        </path>
                                        <g>
                                            <path style="fill:#F8D832;"
                                                d="M308.966,176.552c0-29.255-23.711-52.966-52.966-52.966s-52.966,23.711-52.966,52.966 c0,29.255,23.711,52.966,52.966,52.966S308.966,205.806,308.966,176.552">
                                            </path>
                                            <path style="fill:#F8D832;"
                                                d="M326.621,344.276H185.379v-44.014c0-39,31.62-70.621,70.621-70.621s70.621,31.62,70.621,70.621 V344.276z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </svg>';
                            } elseif ($memberLevel === "Platinum") {
                            echo '<svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                xml:space="preserve" fill="#000000" class="w-6 h-6 mr-3">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <g>
                                            <g>
                                                <polygon style="fill:#dbdbdb;"
                                                    points="87.576,186.821 87.576,325.252 75.311,333.478 75.236,333.478 7.404,379.099 0,384.034 0,128.037 75.236,178.518 ">
                                                </polygon>
                                            </g>
                                            <g>
                                                <polygon style="fill:#dbdbdb;"
                                                    points="190.633,0 190.633,117.567 87.576,186.821 75.236,178.518 0,128.037 ">
                                                </polygon>
                                            </g>
                                            <g>
                                                <polygon style="fill:#c2c2c2;"
                                                    points="381.266,128.037 374.685,132.45 306.03,178.518 293.69,186.821 190.633,117.567 190.633,0 347.762,105.526 ">
                                                </polygon>
                                            </g>
                                            <g>
                                                <polygon style="fill:#dbdbdb;"
                                                    points="293.697,186.801 293.697,325.219 381.239,384.005 381.239,128.015 ">
                                                </polygon>
                                            </g>
                                            <g>
                                                <polygon style="fill:#c2c2c2;"
                                                    points="87.569,325.22 87.569,325.219 0.027,384.005 190.633,512 190.633,394.427 ">
                                                </polygon>
                                            </g>
                                            <g>
                                                <polygon style="fill:#dbdbdb;"
                                                    points="293.697,325.22 190.634,394.428 190.633,394.427 190.633,512 381.239,384.005 381.239,384.005 293.697,325.219 ">
                                                </polygon>
                                            </g>
                                            <g>
                                                <polygon style="fill:#d6dadc;"
                                                    points="75.266,178.539 75.266,333.481 190.633,256.01 "></polygon>
                                            </g>
                                            <g>
                                                <polygon style="fill:#c1cacd;"
                                                    points="190.633,101.069 75.266,178.538 75.266,178.539 190.633,256.01 ">
                                                </polygon>
                                            </g>
                                            <g>
                                                <polygon style="fill:#c1cacd;"
                                                    points="75.266,333.481 75.266,333.482 190.633,410.951 190.633,256.01 ">
                                                </polygon>
                                            </g>
                                            <g>
                                                <polygon style="fill:#d6dadc;"
                                                    points="190.634,101.068 190.633,101.069 190.633,256.01 306.001,178.539 306.001,178.538 ">
                                                </polygon>
                                            </g>
                                            <g>
                                                <polygon style="fill:#c1cacd;"
                                                    points="306.001,333.481 306.001,178.539 190.633,256.01 "></polygon>
                                            </g>
                                            <g>
                                                <polygon style="fill:#c1cacd;"
                                                    points="190.633,410.951 190.634,410.952 306.001,333.482 306.001,333.481 190.633,256.01 ">
                                                </polygon>
                                            </g>
                                            <g style="opacity:0.1;">
                                                <polygon style="fill:#d6dadc;"
                                                    points="190.634,101.068 190.633,101.069 75.266,178.538 75.266,178.539 75.266,333.481 75.266,333.481 190.633,410.951 190.634,410.952 306,333.481 306,333.481 306,178.539 306,178.538 ">
                                                </polygon>
                                                <path style="fill:#FFFFFF;"
                                                    d="M190.633,420.146L67.628,337.551V174.472l123.005-82.595l123.005,82.595v163.079L190.633,420.146z M82.907,329.415l107.726,72.341l107.726-72.341V182.608l-107.726-72.341L82.907,182.608V329.415z">
                                                </path>
                                            </g>
                                        </g>
                                        <polygon style="opacity:0.06;fill:#040000;"
                                            points="37.485,409.158 190.633,512 381.239,384.005 381.239,128.015 343.782,102.862 ">
                                        </polygon>
                                    </g>
                                </g>
                            </svg>';
                            } elseif ($memberLevel === "Diamond") {
                            echo '<svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 504.123 504.123"
                                xml:space="preserve" fill="#000000" class="w-6 h-6 mr-3">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <circle style="fill:#324A5E;" cx="252.062" cy="252.062" r="252.062"></circle>
                                    <polyline style="fill:#84DBFF;"
                                        points="424.566,209.132 355.249,134.302 154.388,134.302 85.071,209.132 ">
                                    </polyline>
                                    <polyline style="fill:#54C0EB;"
                                        points="85.071,209.132 254.818,416.295 424.566,209.132 ">
                                    </polyline>
                                    <polyline style="fill:#84DBFF;"
                                        points="143.754,209.132 254.818,416.295 365.883,209.132 ">
                                    </polyline>
                                    <polyline style="fill:#54C0EB;"
                                        points="365.883,209.132 320.591,134.302 189.046,134.302 143.754,209.132 ">
                                    </polyline>
                                    <polyline style="fill:#84DBFF;"
                                        points="296.96,209.132 279.631,134.302 230.006,134.302 212.677,209.132 ">
                                    </polyline>
                                    <polyline style="fill:#54C0EB;"
                                        points="212.677,209.132 254.818,416.295 296.96,209.132 ">
                                    </polyline>
                                    <g>
                                        <path style="fill:#FFFFFF;"
                                            d="M92.16,239.065c0-22.449-6.302-28.751-28.751-28.751c22.449,0,28.751-6.302,28.751-28.751 c0,22.449,6.302,28.751,28.751,28.751C98.462,210.314,92.16,216.615,92.16,239.065z">
                                        </path>
                                        <path style="fill:#FFFFFF;"
                                            d="M356.037,168.96c0-26.782-7.483-34.265-34.265-34.265c26.782,0,34.265-7.483,34.265-34.265 c0,26.782,7.483,34.265,34.265,34.265C363.52,134.302,356.037,142.178,356.037,168.96z">
                                        </path>
                                        <path style="fill:#FFFFFF;"
                                            d="M152.812,168.96c0-26.782-7.483-34.265-34.265-34.265c26.782,0,34.265-7.483,34.265-34.265 c0,26.782,7.483,34.265,34.265,34.265C160.295,134.302,152.812,142.178,152.812,168.96z">
                                        </path>
                                    </g>
                                </g>
                            </svg>';
                            } elseif ($memberLevel === "Ultimate") {
                            echo '<svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fill="#000000"
                                class="w-6 h-6 mr-3">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="m9.86 27.93a28 28 0 0 1 -4.5-6.77c-1.9-4.05-1.92-6.3-1.5-6.46s6.52.11 9.3.13 4 0 4-.16-.41-4.6-.76-7-.69-4-.49-4.06a27.67 27.67 0 0 1 8.49 2c5 1.83 6 3.61 6 3.61a38 38 0 0 1 9.24-5.22c4.85-1.7 6.76-1.46 6.93-1.17s-2.28 11.39-1.86 11.51a22 22 0 0 0 6.59-1.09c2.73-.89 7-3 7.45-3s.82 3.52-1.06 7.85-2.33 4.92-2.16 5a28.33 28.33 0 0 0 4.06-1.36c1.41-.59 2.15-.68 2.32-.18a15.4 15.4 0 0 1 -2.57 10.52c-3.21 4.26-4.62 4.48-4.74 4.65s0 1.07 3.09 1.71 4.65.59 4.61 1.26a11.58 11.58 0 0 1 -5.3 7.38c-4.09 2.44-4.34 2.44-4.25 2.77s.14 7 0 7.51-1.53 1.39-3.73 1a22.33 22.33 0 0 1 -5.75-1.91 7.89 7.89 0 0 1 -1.21-1s-3.68 1.94-4.55 2.28a7.38 7.38 0 0 1 -1.61.43s0 2.82-.11 3a.92.92 0 0 1 -.87.21 4.88 4.88 0 0 0 -1.57 0 2.09 2.09 0 0 1 -1 0 9.27 9.27 0 0 0 -1.58 0c-.46 0-1.58 0-1.66-.28s-.23-2.7-.23-2.7a12.66 12.66 0 0 1 -4.54-1.21 8.49 8.49 0 0 1 -2.34-1.86 9.38 9.38 0 0 1 -4.84 2.53c-2.65.31-4.07 0-4-.22s2.11-6.82 1.61-6.78-9.17.41-9.88.41-1.5-.81-1.21-1.44 4-6.76 5.41-8.18 2.19-2.3 2.19-2.3a22.44 22.44 0 0 0 -5.54-1.53c-2.74-.31-4.16-1.22-4-1.55a23.31 23.31 0 0 1 4.36-5.35c1.98-1.63 3.76-2.98 3.76-2.98z"
                                        fill="#1d1d1b"></path>
                                    <path
                                        d="m5.86 16.34c.3-.3 13.5.06 13.54-.19s-1.88-11.15-1.5-11.15a46 46 0 0 1 9 3.71c2.63 1.68 2.76 2.3 3.47 2.26s4-3.19 8.43-4.88 5.92-1.8 5.92-1.63-1.44 7.31-1.72 8.64-.44 2.74-.15 2.82a28 28 0 0 0 8.26-1c3.93-1.11 6.74-2.66 6.79-2.37a55.16 55.16 0 0 1 -3.63 9.08c-1.19 1.83-1.67 3.41-1.42 3.54s1.66-.31 4.35-1.12 3-.94 3-.81a13.49 13.49 0 0 1 -2.2 7.64 33 33 0 0 1 -5.56 5.85 4.18 4.18 0 0 0 2 2.6c1.17.53 5.7 1.2 5.66 1.45a12.59 12.59 0 0 1 -5.31 6c-3.51 1.81-3.93 2-4 2.32s.18 7.26-.11 7.3a25.34 25.34 0 0 1 -5-.91c-1.41-.49-2-.94-2-1.06a21.37 21.37 0 0 0 2.83-4.51 12 12 0 0 0 .81-3s4.57.22 5-3-1.89-3.81-2.55-3.92a6.49 6.49 0 0 0 -1.33-.16s1.16-10.3-2.33-16-7.21-8.71-14.76-8.4-11.59 4.29-13.44 12-1.36 12.14-1.36 12.14-3.69.15-3.58 4.72 4.93 3.65 4.93 3.65a7 7 0 0 0 1.1 3.91c1.22 1.86 1.77 2.56 1.77 2.56s-4.88 1.86-4.92 1.58 1.25-4.54 1.08-5-1-1.36-1.3-1.36-9.71.41-9.8 0 2.09-3.76 4.27-6.51 3.25-3.81 3.21-4.18-1.51-2.11-4.72-2.58-4.48-.42-4.4-.54a32.65 32.65 0 0 1 5.35-5.44 7.72 7.72 0 0 0 2.52-2.18 35.44 35.44 0 0 1 -4.45-6.21c-1.77-3.33-1.87-5.53-1.75-5.66z"
                                        fill="#85bfe9"></path>
                                    <path
                                        d="m20.53 12a42.8 42.8 0 0 1 -.83-4.52 21.08 21.08 0 0 1 3.67 1.38c0 .17 0 .88-.12.88a16.26 16.26 0 0 0 -2.16-.44c0 .12.34 2 .3 2.07s-.78.74-.86.63z"
                                        fill="#1d1d1b"></path>
                                    <path
                                        d="m36 9.5a15.63 15.63 0 0 1 3.26-2.14c1.2-.43 1-.63 1.2-.43s.47.87.34 1a19.73 19.73 0 0 0 -3 1.31c-.95.63-1 1-1.23.92s-.45-.49-.57-.66z"
                                        fill="#1d1d1b"></path>
                                    <path
                                        d="m16.48 41.42a26.38 26.38 0 0 1 .7 4.85c-.12 0-2.36-.27-2.38-1.89a3.74 3.74 0 0 1 1.68-2.96z"
                                        fill="#e6e4da"></path>
                                    <path
                                        d="m48.49 41.46c.13-.14 2.37 0 2 1.93s-2.79 2.61-2.84 2.35a24.06 24.06 0 0 1 .65-2.33c.28-1.17-.06-1.7.19-1.95z"
                                        fill="#e6e4da"></path>
                                    <path
                                        d="m31.2 17.22c4 0 8.84.22 12.63 6.83s3.37 11.85 2.34 17.76-2.67 9.44-3.69 10.57a11.44 11.44 0 0 1 -1.28 1.3 15.58 15.58 0 0 0 -2.46-1.6c-.21.08-.5.38-.41.54s2 1.52 1.92 1.65-1.16.88-1.28.75a27 27 0 0 0 -2.47-1.89c-.16 0-.66.38-.57.55s2.37 1.64 2.13 1.81-1.57.76-1.74.63-1.93-1.93-2.09-1.93-.62.25-.5.46 1.43 1.77 1.43 1.77a30.9 30.9 0 0 1 -8.14-.1c-3.7-.68-6.31-4.76-7.5-9.11s-1.19-13.61.1-18.73 3.56-11.2 11.58-11.26z"
                                        fill="#e6e4da"></path>
                                    <path
                                        d="m30.23 58.37c.12-.12 1.25.08 2.37 0s1.66-.06 1.66.06.14 1.83 0 1.87a2.94 2.94 0 0 1 -1.53.06 2.87 2.87 0 0 0 -1.5-.32c-.41.08-.66.38-.79.21a6.4 6.4 0 0 1 -.21-1.88z"
                                        fill="#e6e4da"></path>
                                    <path
                                        d="m22.94 23.31c.33-.12 3-1.73 9.41-1.7s10.06 1.75 10.15 2.25 0 2.45-.35 2.45-2.34-1.39-9.69-1.31-9.46 1.83-9.87 1.55-.85-2.82.35-3.24z"
                                        fill="#1d1d1b"></path>
                                    <path
                                        d="m23.36 24c.25-.52 3.27-1.69 9.33-1.41s8.9 1.3 8.9 1.64.21.87 0 .87a28.74 28.74 0 0 0 -9.18-1.1 43.37 43.37 0 0 0 -8.87 1.27c-.34-.1-.26-1.14-.18-1.27z"
                                        fill="#85bfe9"></path>
                                    <path
                                        d="m35.14 28c2.79-1.14 8-.31 7.81 5.38s-7.13 6.49-9.48 3.31-1.23-7.52 1.67-8.69z"
                                        fill="#1d1d1b"></path>
                                    <path
                                        d="m35.58 28.89c2.28-.94 6.54-.26 6.41 4.41s-5.86 5.33-7.79 2.7-1-6.14 1.38-7.11z"
                                        fill="#ffffff"></path>
                                    <path
                                        d="m23.74 27.85c2.57-1.05 7.35-.29 7.2 4.95s-6.57 6-8.74 3.06-1.13-6.92 1.54-8.01z"
                                        fill="#1d1d1b"></path>
                                    <path
                                        d="m24.15 28.68c2.1-.86 6-.24 5.9 4.07s-5.39 4.91-7.17 2.51-.88-5.68 1.27-6.58z"
                                        fill="#ffffff"></path>
                                    <g fill="#1d1d1b">
                                        <path d="m25.51 31.85a1.07 1.07 0 1 1 -.32 1.7 1.12 1.12 0 0 1 .32-1.7z"></path>
                                        <path d="m37.27 32.29a1.07 1.07 0 1 1 -.33 1.7 1.12 1.12 0 0 1 .33-1.7z"></path>
                                        <path
                                            d="m21.92 37.74a5.37 5.37 0 0 0 3 1.29 9 9 0 0 0 3.08-.31c.2.05.21.65.2.81a6.57 6.57 0 0 1 -3.76.39 5.1 5.1 0 0 1 -3-1.44c-.09-.17.36-.74.48-.74z">
                                        </path>
                                        <path
                                            d="m36.72 39.58a5.4 5.4 0 0 0 3.27 0 8.55 8.55 0 0 0 2.69-1.47c.21 0 .45.52.5.67a6.54 6.54 0 0 1 -3.32 1.82 5.13 5.13 0 0 1 -3.28-.19c-.17-.08.02-.79.14-.83z">
                                        </path>
                                        <path
                                            d="m29.78 39.79c0-.13.73-.3.78-.1s-.13 6.38 1.57 6.34 1.14-6.36 1.3-6.45a2.14 2.14 0 0 1 .79 0s1 7.59-2 7.55-2.43-7.26-2.44-7.34z">
                                        </path>
                                        <path
                                            d="m22.15 49.3a5.38 5.38 0 0 1 .19-1.74c.25-.55 1-1.17 1.16-1.13s.5.45.37.62-.86.58-.9 1.08 0 1.37-.11 1.42a1.18 1.18 0 0 1 -.71-.25z">
                                        </path>
                                        <path
                                            d="m39.07 46.51s.53-.63.7-.63a2.7 2.7 0 0 1 1.5 1.49c.38 1 .39 1.94.1 2s-.79.13-.79 0 .41-1.24 0-1.91a3.37 3.37 0 0 0 -1.51-.95z">
                                        </path>
                                        <path
                                            d="m24.38 48.58c.21.06 2.22 1.43 6.91 1.27a28 28 0 0 0 7.79-1.55 1.9 1.9 0 0 1 .17.83c0 .16-3.35 1.85-8.12 1.76s-6.94-1.23-7-1.4.13-.95.25-.91z">
                                        </path>
                                    </g>
                                </g>
                            </svg>';
                            }
                            @endphp
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
                        <x-dropdown-link :href="route('cart.show')" :active="request()->routeIs('cart.show')">
                            {{ __('Cart') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('favorites.index')"
                            :active="request()->routeIs('favorites.index')">{{ __('Favorite') }}

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

                <form method="POST" action="{{ route('logout') }}" class="text-red">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#search').on('input', function() {
                    let query = $(this).val();

                    if (query.length > 0) {
                        $.ajax({
                            url: "{{ route('search') }}",
                            type: "GET",
                            data: {
                                query: query
                            },
                            success: function(data) {
                                let results = '';

                                if (data.length > 0) {
                                    data.forEach(function(item) {
                                        console.log("AJAX Response:", data);
                                        let link; // Declare link here
                                        let icon; // Declare icon variable

                                        if (item.type === 'image') {
                                            link =
                                                `/images/${item.id}`; // Assign link for images
                                            icon =
                                                '<i class="fas fa-image"></i>'; // Font Awesome image icon
                                        } else {
                                            link =
                                                `/profile/${item.id}`; // Assign link for users
                                            icon =
                                                '<i class="fas fa-user"></i>'; // Font Awesome user icon
                                        }

                                        let title = item.type === 'image' ? item.title :
                                            item.name;

                                        results += `
                                    <div class="p-2 hover:bg-gray-200 cursor-pointer">
                                        <a href="${link}" class="block text-black">${icon} ${title}</a>
                                    </div>
                                `;
                                    });
                                } else {
                                    results =
                                        `<p class="p-2 text-gray-500">No results found</p>`;
                                }

                                $('#search-results').html(results).show();
                            }
                        });
                    } else {
                        $('#search-results').hide();
                    }
                });

                // Hide results when clicking outside
                $(document).click(function(event) {
                    if (!$(event.target).closest('#search').length) {
                        $('#search-results').hide();
                    }
                });
            });
        </script>



    </div>

</nav>