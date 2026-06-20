@php
use Illuminate\Support\Str;
@endphp

<x-app-layout>

<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- HERO SECTION --}}
    @if(count($trendingMovies))

    <div class="relative rounded-3xl overflow-hidden h-[450px] mb-10 border border-slate-800">

        <img
            src="https://image.tmdb.org/t/p/original{{ $trendingMovies[0]['backdrop_path'] }}"
            class="absolute inset-0 w-full h-full object-cover">

        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/80 to-transparent"></div>

        <div class="relative z-10 h-full flex items-center">

            <div class="px-10 max-w-2xl">

                <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                    {{ $trendingMovies[0]['title'] }}
                </h1>

                <p class="mt-5 text-gray-300 text-lg">
                    {{ Str::limit($trendingMovies[0]['overview'], 180) }}
                </p>

                <div class="flex gap-4 mt-8">

                    <a
                        href="#movies"
                        class="bg-purple-600 hover:bg-purple-700 px-6 py-3 rounded-xl font-semibold transition">

                        Browse Movies

                    </a>

                    <a
                        href="{{ route('watchlist.index') }}"
                        class="bg-slate-800 hover:bg-slate-700 px-6 py-3 rounded-xl font-semibold transition">

                        My Watchlist

                    </a>

                </div>

            </div>

        </div>

    </div>

    @endif

    {{-- SEARCH --}}
    <div class="mb-10">

        <form
            action="{{ route('movie.search') }}"
            method="GET"
            class="flex gap-3">

            <input
                type="text"
                name="query"
                placeholder="Search movies..."
                class="flex-1 bg-slate-900 border border-slate-700 rounded-xl px-5 py-3 text-white focus:outline-none focus:border-purple-500">

            <button
                type="submit"
                class="bg-purple-600 hover:bg-purple-700 px-6 rounded-xl font-semibold">

                Search

            </button>

        </form>

    </div>

    {{-- TRENDING MOVIES --}}
    <section id="movies">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">
                🔥 Trending Movies
            </h2>

        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">

            @foreach($trendingMovies as $movie)

                <div
                    class="bg-slate-900 rounded-2xl overflow-hidden border border-slate-800 hover:border-purple-500 hover:scale-105 transition duration-300">

                    <a href="{{ route('movie.show', $movie['id']) }}">

                        <img
                            src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                            alt="{{ $movie['title'] }}"
                            class="w-full h-80 object-cover">

                    </a>

                    <div class="p-4">

                        <h3 class="font-semibold truncate">
                            {{ $movie['title'] }}
                        </h3>

                        <div class="flex justify-between mt-2 text-sm text-gray-400">

                            <span>
                                ⭐ {{ number_format($movie['vote_average'], 1) }}
                            </span>

                            <span>
                                {{ substr($movie['release_date'], 0, 4) }}
                            </span>

                        </div>

                        <form
                            action="{{ route('watchlist.store') }}"
                            method="POST"
                            class="mt-4">

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
                                value="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}">

                            <button
                                type="submit"
                                class="w-full bg-purple-600 hover:bg-purple-700 py-2 rounded-lg font-medium">

                                + Watchlist

                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>

    </section>

    {{-- WATCHLIST --}}
    <section class="mt-16">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">
                📌 My Watchlist
            </h2>

            <a
                href="{{ route('watchlist.index') }}"
                class="text-purple-400 hover:text-purple-300">

                View All →

            </a>

        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">

            @forelse($watchlists->take(5) as $item)

                <div
                    class="bg-slate-900 rounded-xl overflow-hidden border border-slate-800">

                    <img
                        src="{{ $item->poster }}"
                        alt="{{ $item->title }}"
                        class="w-full h-64 object-cover">

                    <div class="p-3">

                        <h3 class="text-sm font-medium truncate">
                            {{ $item->title }}
                        </h3>

                    </div>

                </div>

            @empty

                <div class="col-span-full text-center text-gray-400 py-10">
                    Belum ada film di watchlist.
                </div>

            @endforelse

        </div>

    </section>

    {{-- REVIEWS --}}
    <section class="mt-16">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">
                ⭐ Latest Reviews
            </h2>

            <a
                href="{{ route('reviews.index') }}"
                class="text-purple-400 hover:text-purple-300">

                View All →

            </a>

        </div>

        <div class="space-y-4">

            @forelse($latestReviews as $review)

                <div
                    class="bg-slate-900 border border-slate-800 rounded-2xl p-5">

                    <div class="flex gap-4">

                        <img
                            src="{{ $review->poster }}"
                            alt="{{ $review->title }}"
                            class="w-20 h-28 rounded-lg object-cover">

                        <div>

                            <h3 class="font-bold text-lg">
                                {{ $review->title }}
                            </h3>

                            <p class="text-yellow-400 mt-1">
                                ⭐ {{ $review->rating }}/5
                            </p>

                            <p class="text-gray-300 mt-2">
                                {{ $review->review }}
                            </p>

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-gray-400">
                    Belum ada review.
                </div>

            @endforelse

        </div>

    </section>

</div>

</x-app-layout>