<nav x-data="{ open: false }" class="bg-[#1f2937] border-b border-gray-800 sticky top-0 z-50 shadow-md">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex items-center">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center space-x-2 text-xl font-extrabold tracking-wider text-white mr-10 hover:opacity-90 transition">
                    <i class="fa-solid fa-clapperboard text-teal-400 text-2xl"></i>
                    <span>🎬 CINE<span class="text-teal-400">LIST</span></span>
                </a>

                <div class="hidden sm:flex items-center space-x-6 text-sm font-semibold tracking-wide">

                    <a href="{{ route('dashboard') }}"
                       class="transition duration-150 py-1 {{ request()->routeIs('dashboard') ? 'text-teal-400 border-b-2 border-teal-400 font-bold' : 'text-gray-300 hover:text-white' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('watchlist.index') }}"
                       class="transition duration-150 py-1 {{ request()->routeIs('watchlist.*') ? 'text-teal-400 border-b-2 border-teal-400 font-bold' : 'text-gray-300 hover:text-white' }}">
                        Watchlist
                    </a>

                    <a href="{{ route('reviews.index') }}"
                       class="transition duration-150 py-1 {{ request()->routeIs('reviews.*') ? 'text-teal-400 border-b-2 border-teal-400 font-bold' : 'text-gray-300 hover:text-white' }}">
                        Reviews
                    </a>

                </div>

            </div>

            <div class="hidden sm:flex sm:items-center">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="flex items-center gap-2.5 text-sm font-medium text-white hover:text-teal-400 transition bg-slate-800/40 py-1.5 pl-2 pr-3 rounded-full border border-gray-700/30">

                            <div class="w-7 h-7 rounded-full bg-teal-600 text-white font-bold flex items-center justify-center text-xs shadow-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <span>
                                {{ Auth::user()->name }}
                            </span>

                            <svg class="fill-current h-4 w-4 opacity-70"
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

            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                    class="text-gray-400 hover:text-white p-2 rounded-lg hover:bg-gray-800 transition focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         class="sm:hidden bg-[#111827] border-t border-gray-800 py-2 space-y-1 shadow-inner">

        <a href="{{ route('dashboard') }}"
           class="block px-6 py-2.5 text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-teal-600/10 text-teal-400' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
            Dashboard
        </a>

        <a href="{{ route('watchlist.index') }}"
           class="block px-6 py-2.5 text-sm font-medium {{ request()->routeIs('watchlist.*') ? 'bg-teal-600/10 text-teal-400' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
            Watchlist
        </a>

        <a href="{{ route('reviews.index') }}"
           class="block px-6 py-2.5 text-sm font-medium {{ request()->routeIs('reviews.*') ? 'bg-teal-600/10 text-teal-400' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
            Reviews
        </a>

        <div class="border-t border-gray-800 my-2 pt-2 px-6">
            <a href="{{ route('profile.edit') }}" class="block py-2 text-xs text-gray-400 hover:text-white">Profile Settings</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left py-2 text-xs text-red-400 hover:text-red-300">Logout</button>
            </form>
        </div>

    </div>

</nav>