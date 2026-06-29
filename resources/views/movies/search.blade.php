<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-screen">

        <div class="mb-8">

    <a href="{{ route('dashboard') }}"
        class="inline-flex items-center gap-2 bg-slate-800/60 hover:bg-slate-800 text-gray-300 hover:text-white px-4 py-2 rounded-xl text-sm font-medium border border-gray-700/50 shadow-sm transition duration-200 group mb-6">

        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>

        Kembali ke Dashboard

    </a>

    <h1 class="text-3xl font-bold text-white">
        Hasil Pencarian
    </h1>

    <p class="text-gray-400 mt-2">
        Menampilkan hasil pencarian untuk
        <span class="text-teal-400 font-semibold">"{{ $query }}"</span>
    </p>

</div>

<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">

    @forelse($searchResult as $movie)

        <div class="bg-slate-900 rounded-2xl overflow-hidden border border-slate-800 hover:border-cyan-500 transition shadow-lg group">

            <div class="relative">

                <a href="{{ route('movie.show', $movie['id']) }}">

                    @if(!empty($movie['poster_path']))
                        <img
                            src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                            class="w-full h-80 object-cover group-hover:scale-105 transition duration-300">
                    @else
                        <div class="w-full h-80 bg-slate-800 flex items-center justify-center text-gray-500">
                            No Poster
                        </div>
                    @endif

                </a>

                <span class="absolute top-3 left-3 bg-yellow-400 text-black text-xs px-2 py-1 rounded-lg font-bold">
                    ⭐ {{ number_format($movie['vote_average'],1) }}
                </span>

            </div>

            <div class="p-4">

                <h2 class="text-white font-semibold line-clamp-2">
                    {{ $movie['title'] }}
                </h2>

                <p class="text-gray-400 text-sm mt-1">
                    {{ isset($movie['release_date']) ? date('Y', strtotime($movie['release_date'])) : '-' }}
                </p>

                <form action="{{ route('watchlist.store') }}" method="POST" class="mt-4">
                    @csrf

                    <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                    <input type="hidden" name="title" value="{{ $movie['title'] }}">
                    <input type="hidden" name="poster" value="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] ?? '' }}">

                    <button
                        class="w-full bg-teal-600 hover:bg-teal-500 py-2 rounded-lg text-white text-sm font-semibold">
                        + Add to Watchlist
                    </button>
                </form>

                

            </div>

        </div>

    @empty

                <div class="col-span-full">

                    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-16 text-center">

                        <div class="text-7xl mb-5">

                            🔍

                        </div>

                        <h2 class="text-3xl font-bold text-white">

                            Film Tidak Ditemukan

                        </h2>

                        <p class="text-gray-400 mt-3">

                            Maaf, kami tidak menemukan film dengan kata kunci
                            <span class="text-teal-400 font-semibold">
                                "{{ $query }}"
                            </span>.

                        </p>

                        <p class="text-gray-500 text-sm mt-2">

                            Coba gunakan kata kunci lain atau periksa kembali ejaannya.

                        </p>

                        <a
                            href="{{ route('dashboard') }}"
                            class="inline-flex items-center gap-2 mt-8 bg-teal-600 hover:bg-teal-500 text-white px-6 py-3 rounded-xl font-semibold transition">

                            🎬 Jelajahi Film

                        </a>

                    </div>

                </div>

@endforelse

        </div>
    </main>
</x-app-layout>