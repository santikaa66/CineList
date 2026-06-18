<x-app-layout>
    <main class="container" style="padding: 40px 8%; margin-top: 20px;">
        <a href="javascript:history.back()" style="color: #a0a0b0; text-decoration: none; display: inline-block; margin-bottom: 20px; font-weight: 600;">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>

        @if(isset($movie))
            <div class="movie-detail-wrapper" style="display: flex; gap: 40px; flex-wrap: wrap;">
                
                <div class="detail-poster" style="flex: 1; min-width: 280px; max-width: 350px;">
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] ?? '' }}" alt="{{ $movie['title'] ?? '' }}" style="width: 100%; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
                </div>

                <div class="detail-info" style="flex: 2; min-width: 300px; color: #fff;">
                    <h1 style="font-size: 38px; margin-bottom: 10px; font-weight: 800; line-height: 1.2;">{{ $movie['title'] ?? '' }}</h1>
                    
                    <div class="meta-items" style="display: flex; gap: 15px; margin-bottom: 20px; color: #a0a0b0; font-size: 14px;">
                        <span><i class="fa-solid fa-star" style="color: #ffcf00;"></i> {{ number_format($movie['vote_average'] ?? 0, 1) }} / 10</span>
                        <span>•</span>
                        <span>{{ $movie['release_date'] ?? 'N/A' }}</span>
                    </div>

                    <div class="overview" style="margin-bottom: 30px;">
                        <h3 style="margin-bottom: 10px; color: #6c5ce7; font-size: 18px; font-weight: 700;">Sinopsis</h3>
                        <p style="line-height: 1.6; color: #e0e0e0; font-size: 15px;">
                            {{ $movie['overview'] ?? 'Sinopsis tidak tersedia.' }}
                        </p>
                    </div>

                    <div class="actors-section" style="margin-bottom: 30px;">
                        <h3 style="margin-bottom: 12px; color: #6c5ce7; font-size: 18px; font-weight: 700;">Pemain Utama</h3>
                        <div class="actors-list" style="display: flex; gap: 15px; flex-wrap: wrap;">
                            @forelse($actors ?? [] as $actor)
                                <div class="actor-card" style="background: #1a1a24; padding: 8px 15px; border-radius: 20px; border: 1px solid #333; font-size: 14px;">
                                    <i class="fa-solid fa-user" style="color: #a0a0b0; margin-right: 5px;"></i> {{ $actor['name'] }}
                                </div>
                            @empty
                                <p style="color: #a0a0b0; font-size: 14px;">Data pemain tidak tersedia.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="action-buttons" style="display: flex; gap: 15px; max-width: 300px;">
                        <form action="{{ route('watchlist.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                            <input type="hidden" name="title" value="{{ $movie['title'] }}">

                            <input
                                type="hidden"
                                name="poster"
                                value="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] ?? '' }}">

                            <button
                                type="submit"
                                style="background:#6c5ce7;color:white;border:none;padding:12px;border-radius:8px;cursor:pointer;font-weight:600;width:100%;">
                                <i class="fa-solid fa-plus"></i>
                                Add to Watchlist
                            </button>
                        </form>

                        <div style="margin-top:30px; width:100%; max-width:500px;">

                            <h3 style="margin-bottom:12px; color:#f59e0b; font-size:18px; font-weight:700;">
                                ⭐ Tulis Review
                            </h3>

                            <form action="{{ route('reviews.store') }}" method="POST">


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

                                <div style="margin-bottom:12px;">
                                    <label style="display:block; margin-bottom:6px; color:#e0e0e0;">
                                        Rating
                                    </label>

                                    <select
                                        name="rating"
                                        required
                                        style="width:100%; padding:10px; border-radius:8px; color:black;">

                                        <option value="1">⭐ 1</option>
                                        <option value="2">⭐⭐ 2</option>
                                        <option value="3">⭐⭐⭐ 3</option>
                                        <option value="4">⭐⭐⭐⭐ 4</option>
                                        <option value="5">⭐⭐⭐⭐⭐ 5</option>

                                    </select>
                                </div>

                                <div style="margin-bottom:12px;">
                                    <label style="display:block; margin-bottom:6px; color:#e0e0e0;">
                                        Review
                                    </label>

                                    <textarea
                                        name="review"
                                        rows="4"
                                        required
                                        placeholder="Tulis pendapatmu tentang film ini..."
                                        style="width:100%; padding:10px; border-radius:8px; color:black;"></textarea>
                                </div>

                                <button
                                    type="submit"
                                    style="background:#f59e0b; color:white; border:none; padding:12px; border-radius:8px; cursor:pointer; font-weight:600; width:100%;">

                                    ⭐ Simpan Review

                                </button>

                            </form>

                        </div>

                    </div>
                </div>

            </div>
        @else
            <p style="color: #a0a0b0;">Data film tidak ditemukan.</p>
        @endif
    </main>
</x-app-layout>