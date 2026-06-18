<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🎬 CineList Dashboard
        </h2>
    </x-slot>

    <div class="py-6">

        <!-- HERO -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div
                class="bg-gradient-to-r from-slate-900 to-indigo-950 overflow-hidden shadow-xl rounded-2xl text-center p-12 relative"
                style="background-image:
                linear-gradient(rgba(15,15,20,.80),rgba(15,15,20,.90)),
                url('https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?w=1600');
                background-size:cover;
                background-position:center;">

                <div class="relative z-10">

                    <h1 class="text-4xl font-extrabold text-white mb-3">
                        Track Your Cinema Journey
                    </h1>

                    <p class="text-gray-300 mb-8 max-w-xl mx-auto">
                        Urus daftar tontonanmu, simpan film favorit,
                        dan temukan rekomendasi film terbaik dari seluruh dunia.
                    </p>

                    <form
                        action="{{ route('movie.search') }}"
                        method="GET"
                        class="flex max-w-md mx-auto bg-slate-800/80 rounded-full p-2">

                        <input
                            type="text"
                            name="query"
                            placeholder="Cari judul film..."
                            required
                            class="flex-1 bg-transparent border-none text-white px-4 focus:ring-0 outline-none">

                        <button
                            type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-full">
                            Cari
                        </button>

                    </form>

                </div>

            </div>

        </div>



        <!-- TRENDING -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                    🔥 Trending Movies
                </h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">

                @forelse($trendingMovies ?? [] as $movie)

                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">

                        <!-- POSTER -->
                        <a href="{{ route('movie.show', $movie['id']) }}">

                            @if(!empty($movie['poster_path']))
                                <img
                                    src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                                    alt="{{ $movie['title'] }}"
                                    class="w-full h-80 object-cover">
                            @else
                                <div class="w-full h-80 flex items-center justify-center bg-gray-200">
                                    No Poster
                                </div>
                            @endif

                        </a>

                        <!-- INFO -->
                        <div class="p-4">

                            <h3 class="font-bold text-gray-900 dark:text-white line-clamp-2">
                                {{ $movie['title'] }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                ⭐ {{ number_format($movie['vote_average'] ?? 0,1) }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ isset($movie['release_date']) ? date('Y', strtotime($movie['release_date'])) : 'N/A' }}
                            </p>

                            <!-- DETAIL -->
                            <a
                                href="{{ route('movie.show', $movie['id']) }}"
                                class="block text-center mt-4 bg-gray-800 hover:bg-black text-white py-2 rounded-lg text-sm">
                                🎬 Detail
                            </a>

                            <!-- WATCHLIST -->
                            <form
                                action="{{ route('watchlist.store') }}"
                                method="POST"
                                class="mt-2">

                                @csrf

                                <input
                                    type="hidden"
                                    name="movie_id"
                                    value="{{ $movie['id'] }}">

                                <input
                                    type="hidden"
                                    name="title"
                                    value="{{ $movie['title'] }}">

                                <input
                                    type="hidden"
                                    name="poster"
                                    value="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] ?? '' }}">

                                <button
                                    type="submit"
                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg text-sm">
                                    ➕ Add to Watchlist
                                </button>

                            </form>

                        </div>

                    </div>

                @empty

                    <div class="col-span-full">

                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-8 text-center">

                            <p class="text-gray-500">
                                Tidak ada film trending saat ini atau koneksi TMDB bermasalah.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </div>
</x-app-layout>