<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-screen">

        <div class="mb-8">
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center gap-2 bg-slate-800/60 hover:bg-slate-800 text-gray-300 hover:text-white px-4 py-2 rounded-xl text-sm font-medium border border-gray-700/50 shadow-sm transition duration-200 group mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Dashboard
            </a>

            <h2 class="text-2xl font-bold text-white tracking-wide mt-2">
                Hasil pencarian untuk: 
                <span class="text-teal-400">"{{ $query }}"</span>
            </h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">

            @forelse($searchResult ?? [] as $movie)
                <div class="bg-[#1f2937] rounded-xl shadow-lg overflow-hidden flex flex-col justify-between border border-gray-800 hover:border-gray-700 transition duration-200 group">

                    <div class="relative overflow-hidden">
                        <a href="{{ route('movie.show', $movie['id']) }}" class="block">
                            @if(!empty($movie['poster_path']))
                                <img
                                    src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                                    alt="{{ $movie['title'] ?? '' }}"
                                    class="w-full h-80 object-cover transform group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-80 flex flex-col items-center justify-center bg-gray-700 text-gray-400">
                                    <i class="fa-solid fa-image text-3xl mb-2"></i>
                                    <span class="text-xs">No Poster</span>
                                </div>
                            @endif
                        </a>
                        
                        <span class="absolute top-3 left-3 bg-black/75 backdrop-blur-sm px-2.5 py-1 rounded-lg text-xs font-bold text-yellow-400 flex items-center gap-1 shadow">
                            ⭐ {{ number_format($movie['vote_average'] ?? 0, 1) }}
                        </span>
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1f2937] via-transparent to-transparent pointer-events-none"></div>
                    </div>

                    <div class="p-4 pt-2 flex-1 flex flex-col justify-between space-y-4">
                        <div>
                            <h3 class="font-bold text-sm text-white line-clamp-1 group-hover:text-teal-400 transition" title="{{ $movie['title'] ?? '' }}">
                                {{ $movie['title'] ?? '' }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-1">
                                Release: {{ isset($movie['release_date']) && $movie['release_date'] ? date('Y', strtotime($movie['release_date'])) : 'N/A' }}
                            </p>
                        </div>

                        <form action="{{ route('watchlist.store') }}" method="POST" class="m-0">
                            @csrf
                            <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                            <input type="hidden" name="title" value="{{ $movie['title'] ?? '' }}">
                            <input type="hidden" name="poster" value="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] ?? '' }}">

                            <button
                                type="submit"
                                class="w-full bg-teal-600 hover:bg-teal-500 text-white py-2 rounded-lg text-xs font-bold transition shadow-sm flex items-center justify-center gap-1.5">
                                <span>➕ Watchlist</span>
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-[#1f2937] rounded-xl shadow p-12 text-center border border-gray-800">
                        <p class="text-gray-400 text-sm">
                            Ups! Film yang kamu cari tidak ditemukan. Silakan coba kata kunci lain.
                        </p>
                    </div>
                </div>
            @endforelse

        </div>
    </main>
</x-app-layout>