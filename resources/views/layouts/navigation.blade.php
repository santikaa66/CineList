<nav x-data="{ open: false }"
    class="bg-gradient-to-r from-slate-950 via-slate-900 to-slate-950 border-b border-slate-800 sticky top-0 z-50 backdrop-blur-md">

    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-20">

            {{-- Logo --}}
            <div class="flex items-center gap-12">

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3">

                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-r from-violet-600 to-purple-500 flex items-center justify-center shadow-lg">

                        🎬

                    </div>

                    <span class="text-3xl font-extrabold text-white">
                        Cine<span class="text-violet-400">List</span>
                    </span>

                </a>

                {{-- Menu --}}
                <div class="hidden lg:flex items-center gap-8">

                    <a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') ? 'text-violet-400 border-b-2 border-violet-500' : 'text-gray-300 hover:text-white' }} pb-1 font-medium transition">

                        Dashboard

                    </a>

                    <a href="{{ route('watchlist.index') }}"
                        class="{{ request()->routeIs('watchlist.*') ? 'text-violet-400 border-b-2 border-violet-500' : 'text-gray-300 hover:text-white' }} pb-1 font-medium transition">

                        Watchlist

                    </a>

                    <a href="{{ route('reviews.index') }}"
                        class="{{ request()->routeIs('reviews.*') ? 'text-violet-400 border-b-2 border-violet-500' : 'text-gray-300 hover:text-white' }} pb-1 font-medium transition">

                        Reviews

                    </a>

                </div>

            </div>

            {{-- Search + Profile --}}
            <div class="hidden lg:flex items-center gap-5">

                {{-- Search --}}
                <form
                    action="{{ route('movie.search') }}"
                    method="GET"
                    class="relative">

                    <input
                        type="text"
                        name="query"
                        placeholder="Search movies..."
                        class="w-72 bg-slate-800 border border-slate-700 rounded-full py-2.5 pl-11 pr-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-violet-500">

                    <i
                        class="fa-solid fa-magnifying-glass absolute left-4 top-3 text-gray-400">
                    </i>

                </form>

                {{-- User Dropdown --}}
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            class="flex items-center gap-3 bg-slate-800 border border-slate-700 rounded-full px-3 py-2 hover:border-violet-500 transition">

                            <div
                                class="w-9 h-9 rounded-full bg-violet-600 flex items-center justify-center font-bold text-white">

                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                            </div>

                            <span class="text-white font-medium">
                                {{ Auth::user()->name }}
                            </span>

                            <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>

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
                                onclick="event.preventDefault(); this.closest('form').submit();">

                                Logout

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            {{-- Mobile Button --}}
            <div class="lg:hidden">

                <button
                    @click="open = !open"
                    class="text-white">

                    <i class="fa-solid fa-bars text-xl"></i>

                </button>

            </div>

        </div>
    </div>

    {{-- Mobile Menu --}}
    <div
        x-show="open"
        x-transition
        class="lg:hidden bg-slate-900 border-t border-slate-800">

        <div class="p-4 space-y-3">

            <form
                action="{{ route('movie.search') }}"
                method="GET">

                <input
                    type="text"
                    name="query"
                    placeholder="Search movies..."
                    class="w-full bg-slate-800 border border-slate-700 rounded-lg p-3 text-white">

            </form>

            <a
                href="{{ route('dashboard') }}"
                class="block text-gray-300 hover:text-white">

                Dashboard

            </a>

            <a
                href="{{ route('watchlist.index') }}"
                class="block text-gray-300 hover:text-white">

                Watchlist

            </a>

            <a
                href="{{ route('reviews.index') }}"
                class="block text-gray-300 hover:text-white">

                Reviews

            </a>

            <a
                href="{{ route('profile.edit') }}"
                class="block text-gray-300 hover:text-white">

                Profile

            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="text-red-400">

                    Logout

                </button>

            </form>

        </div>

    </div>

</nav>