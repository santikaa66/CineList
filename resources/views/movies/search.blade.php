<x-app-layout>
    <main class="container" style="padding: 40px 8%; margin-top: 20px;">

        <div class="search-header" style="margin-bottom: 30px;">
            <a href="{{ route('dashboard') }}"
               style="color: #6c5ce7; text-decoration: none; margin-bottom: 10px; display: inline-block; font-weight: 600;">

                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke Dashboard

            </a>

            <h2 style="font-size: 24px; color: #fff; margin-top: 10px;">
                Hasil pencarian untuk:
                <span style="color: #6c5ce7;">
                    "{{ $query }}"
                </span>
            </h2>
        </div>

        <div class="movie-grid"
             style="display: grid;
                    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
                    gap: 30px;">

            @forelse($searchResult ?? [] as $movie)

                <div class="movie-card"
                     style="background: #1a1a24;
                            border-radius: 12px;
                            overflow: hidden;
                            display: flex;
                            flex-direction: column;">

                    <!-- Poster -->
                    <a href="{{ route('movie.show', $movie['id']) }}"
                       style="text-decoration: none; color: inherit;">

                        <div class="poster-wrapper"
                             style="position: relative; height: 320px;">

                            <img
                                src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] ?? '' }}"
                                alt="{{ $movie['title'] ?? '' }}"
                                style="width:100%; height:100%; object-fit:cover;">

                            <span
                                style="position:absolute;
                                       top:15px;
                                       left:15px;
                                       background:rgba(0,0,0,0.75);
                                       padding:5px 10px;
                                       border-radius:6px;
                                       font-size:12px;
                                       font-weight:700;
                                       color:#ffcf00;">

                                <i class="fa-solid fa-star"></i>
                                {{ number_format($movie['vote_average'] ?? 0, 1) }}

                            </span>

                        </div>

                    </a>

                    <!-- Info -->
                    <div class="movie-info"
                         style="padding:15px;
                                display:flex;
                                flex-direction:column;
                                flex:1;
                                justify-content:space-between;">

                        <div>
                            <a href="{{ route('movie.show', $movie['id']) }}"
                               style="text-decoration:none; color:#fff;">

                                <h3 style="font-size:16px;
                                           margin-bottom:5px;
                                           white-space:nowrap;
                                           overflow:hidden;
                                           text-overflow:ellipsis;">

                                    {{ $movie['title'] ?? '' }}

                                </h3>

                            </a>

                            <p style="color:#a0a0b0;
                                      font-size:12px;
                                      margin-bottom:15px;">

                                Release:
                                {{ $movie['release_date'] ?? 'N/A' }}

                            </p>
                        </div>

                        <!-- Add Watchlist -->
                        <form action="{{ route('watchlist.store') }}"
                              method="POST">

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
                                style="background:#6c5ce7;
                                        color:white;
                                        border:none;
                                        padding:10px;
                                        border-radius:8px;
                                        cursor:pointer;
                                        font-weight:600;
                                        font-size:13px;
                                        width:100%;">

                                <i class="fa-solid fa-plus"></i>
                                Add to Watchlist

                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="no-results"
                    style="grid-column:1/-1;
                            text-align:center;
                            padding:50px 0;">

                    <p style="color:#a0a0b0; font-size:16px;">
                        Ups! Film yang kamu cari tidak ditemukan.
                    </p>

                </div>

            @endforelse

        </div>

    </main>
</x-app-layout>