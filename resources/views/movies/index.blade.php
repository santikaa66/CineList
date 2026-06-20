<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            CineList Dashboard
        </h2>
    </x-slot>

    <div class="py-6 bg-[#111827] min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-gradient-to-r from-slate-900 via-indigo-950 to-transparent overflow-hidden shadow-xl rounded-2xl p-8 md:p-12 relative flex items-center min-h-[220px]"
                style="background-image:
                linear-gradient(rgba(17, 24, 39, 0.8), rgba(17, 24, 39, 0.85)),
                url('https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?w=1600');
                background-size: cover;
                background-position: center;">

                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6 w-full">
                    
                    <div class="text-center md:text-left max-w-xl">
                        <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-2 tracking-wide">
                            Welcome, {{ Auth::user()->name }}!
                        </h1>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            Check out your new recommendations and explore millions of films.
                        </p>
                    </div>

                    <div class="w-full md:w-80 lg:w-96 shrink-0">
                        <form
                            action="{{ route('movie.search') }}"
                            method="GET"
                            class="flex bg-slate-900/60 rounded-full p-1.5 backdrop-blur-sm border border-gray-700/60 focus-within:ring-2 focus-within:ring-teal-500 transition w-full">
                            
                            <input
                                type="text"
                                name="query"
                                placeholder="Cari judul film..."
                                required
                                class="flex-1 !bg-transparent border-none text-white px-4 text-sm focus:ring-0 outline-none placeholder-gray-500 w-full">

                            <button
                                type="submit"
                                class="bg-teal-600 hover:bg-teal-500 text-white text-sm font-semibold px-6 py-2 rounded-full shadow-md transition duration-200 shrink-0">
                                Cari
                            </button>
                        </form>
                    </div>

                </div>

            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-12">
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-lg font-bold uppercase tracking-wider text-gray-200 flex items-center gap-2">
                    <span>🔥</span> Trending Movies
                </h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">

                @forelse($trendingMovies ?? [] as $movie)
                    <div class="bg-[#1f2937] dark:bg-[#1f2937] rounded-xl shadow-lg overflow-hidden flex flex-col justify-between border border-gray-800 hover:border-gray-700 transition duration-200">

                        <div class="relative group">
                            <a href="{{ route('movie.show', $movie['id']) }}" class="block overflow-hidden">
                                @if(!empty($movie['poster_path']))
                                    <img
                                        src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                                        alt="{{ $movie['title'] }}"
                                        class="w-full h-80 object-cover transform group-hover:scale-105 transition duration-300">
                                @else
                                    <div class="w-full h-80 flex flex-col items-center justify-center bg-gray-700 text-gray-400">
                                        <i class="fa-solid fa-image text-3xl mb-2"></i>
                                        <span class="text-xs">No Poster</span>
                                    </div>
                                @endif
                            </a>
                            <div class="absolute inset-0 bg-gradient-to-t from-[#1f2937] via-transparent to-transparent pointer-events-none"></div>
                        </div>

                        <div class="p-4 pt-1 flex-1 flex flex-col justify-between space-y-3">
                            <div>
                                <h3 class="font-bold text-sm text-white line-clamp-1 group-hover:text-teal-400 transition" title="{{ $movie['title'] }}">
                                    {{ $movie['title'] }}
                                </h3>
                                
                                <div class="flex items-center justify-between mt-1 text-xs text-gray-400">
                                    <span class="text-yellow-400 font-medium">
                                        ⭐ {{ number_format($movie['vote_average'] ?? 0, 1) }}
                                    </span>
                                    <span>
                                        {{ isset($movie['release_date']) ? date('Y', strtotime($movie['release_date'])) : 'N/A' }}
                                    </span>
                                </div>
                            </div>

                            <div class="space-y-2 pt-1">
                                <a
                                    href="{{ route('movie.show', $movie['id']) }}"
                                    class="block text-center bg-gray-800 hover:bg-gray-700 text-gray-200 py-1.5 rounded-lg text-xs font-semibold transition">
                                    🎬 Detail
                                </a>

                                <form
                                    action="{{ route('watchlist.store') }}"
                                    method="POST"
                                    class="m-0">
                                    @csrf
                                    <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                                    <input type="hidden" name="title" value="{{ $movie['title'] }}">
                                    <input type="hidden" name="poster" value="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] ?? '' }}">

                                    <button
                                        type="submit"
                                        class="w-full bg-teal-600 hover:bg-teal-500 text-white py-1.5 rounded-lg text-xs font-bold transition shadow-sm flex items-center justify-center gap-1">
                                        <span>➕ Watchlist</span>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-[#1f2937] rounded-xl shadow p-8 text-center border border-gray-800">
                            <p class="text-gray-400 text-sm">
                                Tidak ada film trending saat ini atau koneksi TMDB bermasalah.
                            </p>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>

    </div>
</x-app-layout>