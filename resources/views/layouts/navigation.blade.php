<nav x-data="{ open: false }" class="bg-[#0f172a] border-b border-slate-800">

    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between h-16">

            <!-- Left Side -->
            <div class="flex items-center">

                <!-- Logo -->
                <a href="{{ route('dashboard') }}"
                   class="text-2xl font-extrabold text-white mr-10">
                    🎬 CineList
                </a>

                <!-- Menu -->
                <div class="hidden sm:flex items-center space-x-8">

                    <a href="{{ route('dashboard') }}"
                       class="{{ request()->routeIs('dashboard') ? 'text-indigo-400 font-semibold' : 'text-gray-300 hover:text-white' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('watchlist.index') }}"
                       class="{{ request()->routeIs('watchlist.*') ? 'text-indigo-400 font-semibold' : 'text-gray-300 hover:text-white' }}">
                        Watchlist
                    </a>

                    <a href="{{ route('reviews.index') }}"
                       class="{{ request()->routeIs('reviews.*') ? 'text-indigo-400 font-semibold' : 'text-gray-300 hover:text-white' }}">
                        Reviews
                    </a>

                </div>

            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex sm:items-center">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 text-white hover:text-indigo-400">

                            <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <span>
                                {{ Auth::user()->name }}
                            </span>

                            <svg class="fill-current h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">

                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />

                            </svg>

                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">

                                Logout

                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            <!-- Mobile Button -->
            <div class="flex items-center sm:hidden">

                <button @click="open = !open"
                    class="text-white">

                    <svg class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>

                    </svg>

                </button>

            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="sm:hidden bg-slate-900">

        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 text-white">
            Dashboard
        </a>

        <a href="{{ route('watchlist.index') }}"
           class="block px-4 py-2 text-white">
            Watchlist
        </a>

        <a href="{{ route('reviews.index') }}"
           class="block px-4 py-2 text-white">
            Reviews
        </a>

    </div>

</nav>