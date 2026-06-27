<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-screen">
        
        <div class="mb-8">
            <a href="javascript:history.back()" 
                class="inline-flex items-center gap-2 bg-slate-800/60 hover:bg-slate-800 text-gray-300 hover:text-white px-4 py-2 rounded-xl text-sm font-medium border border-gray-700/50 shadow-sm transition duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        @if(isset($movie))
            <div class="flex flex-col lg:flex-row gap-10 items-start">
                <div class="w-full sm:w-80 shrink-0 mx-auto lg:mx-0">
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] ?? '' }}" 
                        alt="{{ $movie['title'] ?? '' }}" 
                        class="w-full rounded-3xl shadow-2xl border border-slate-700 object-cover hover:scale-105 transition duration-300">
                </div>
                <div class="flex-1 space-y-6 text-white w-full">
                    <div>

    <h1 class="text-5xl font-bold text-white">
        {{ $movie['title'] }}
    </h1>

    <div class="flex items-center gap-4 mt-3 text-gray-400">
        <span class="text-yellow-400 font-semibold">
            ⭐ {{ number_format($movie['vote_average'],1) }}/10
        </span>
        <span>•</span>
        <span>
            {{ \Carbon\Carbon::parse($movie['release_date'])->format('d M Y') }}
        </span>
    </div>

    {{-- Genre --}}
    <div class="flex flex-wrap gap-2 mt-4">
        @foreach($movie['genres'] as $genre)

            <span class="px-3 py-1 rounded-full bg-cyan-500/20 border border-cyan-500/30 text-cyan-300 text-sm">
                {{ $genre['name'] }}
            </span>

        @endforeach
    </div>

</div>
                    <div class="space-y-2">
                        <h3 class="text-teal-400 font-bold text-sm tracking-wide uppercase">Sinopsis</h3>
                        <p class="text-gray-300 text-sm leading-relaxed max-w-3xl">
                            {{ $movie['overview'] ?? 'Sinopsis tidak tersedia.' }}
                        </p>
                    </div>

                    <div class="space-y-3">
                        <h3 class="text-teal-400 font-bold text-sm tracking-wide uppercase">Pemain Utama</h3>
                        <div class="flex flex-wrap gap-2">
                            @forelse($actors ?? [] as $actor)
                                <div class="bg-slate-900 border border-slate-700 hover:border-cyan-500 transition text-gray-300 px-4 py-2 rounded-full text-sm">
                                    <i class="fa-solid fa-user text-gray-400"></i> {{ $actor['name'] }}
                                </div>
                            @empty
                                <p class="text-gray-400 text-xs italic">Data pemain tidak tersedia.</p>
                            @endforelse
                        </div>
                    </div>

                    @if(isset($trailer))

                    <div class="space-y-3">
                        <h3 class="text-xl font-bold text-white mb-4">
                            🎬 Official Trailer
                        </h3>
                        <div class="aspect-video rounded-2xl overflow-hidden shadow-xl">
                            <iframe
                                class="w-full h-full"
                                src="https://www.youtube.com/embed/{{ $trailer['key'] }}"
                                title="Movie Trailer"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>

                    @endif
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

    <div class="bg-slate-800 rounded-xl p-4">
        <p class="text-gray-400 text-xs">
            STATUS
        </p>
        <p class="font-semibold mt-2">
            {{ $movie['status'] }}
        </p>
    </div>

    <div class="bg-slate-800 rounded-xl p-4">
        <p class="text-gray-400 text-xs">
            RUNTIME
        </p>
        <p class="font-semibold mt-2">
            {{ $movie['runtime'] }} min
        </p>
    </div>

    <div class="bg-slate-800 rounded-xl p-4">
        <p class="text-gray-400 text-xs">
            LANGUAGE
        </p>
        <p class="font-semibold mt-2">
            {{ strtoupper($movie['original_language']) }}
        </p>
    </div>

    <div class="bg-slate-800 rounded-xl p-4">
        <p class="text-gray-400 text-xs">
            RATING
        </p>
        <p class="font-semibold text-yellow-400 mt-2">
            ⭐ {{ number_format($movie['vote_average'],1) }}
        </p>
    </div>

</div>
                    <div class="pt-2 max-w-xs">
                        @php
                            // Kita paksa ID-nya menjadi Integer (angka bersih) agar sinkron dengan database
                            $currentMovieId = isset($movie['id']) ? (int)$movie['id'] : 0;

                            $sudahAda = auth()->user() 
                                ? \App\Models\Watchlist::where('user_id', auth()->id())
                                                        ->where('movie_id', $currentMovieId)
                                                        ->exists() 
                                : false;
                        @endphp

                        @if($sudahAda)
                            <button type="button" disabled 
                                    class="w-full bg-slate-800 text-gray-400 font-bold text-sm py-3 px-4 rounded-xl border border-gray-700/60 cursor-not-allowed flex items-center justify-center gap-2">
                                ✅ Already in Watchlist
                            </button>
                        @else
                            <form action="{{ route('watchlist.store') }}" method="POST" class="m-0">
                                @csrf
                                <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                                <input type="hidden" name="title" value="{{ $movie['title'] }}">
                                <input type="hidden" name="poster" value="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] ?? '' }}">

                                <button type="submit" class="w-full bg-teal-600 hover:bg-teal-500 text-white font-bold text-sm py-3 px-4 rounded-xl shadow-md transition duration-200 flex items-center justify-center gap-2">
                                    + Add to Watchlist
                                </button>
                            </form>
                        @endif
                    </div>

                    <hr class="border-gray-800/80 my-6">

                    <div class="bg-slate-900/40 border border-gray-800/80 rounded-2xl p-6 w-full shadow-inner">
                        <h3 class="text-amber-500 font-bold text-base flex items-center gap-2 mb-4">
                            ⭐ Tulis Review
                        </h3>

                        <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                            <input type="hidden" name="title" value="{{ $movie['title'] }}">
                            <input type="hidden" name="poster" value="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] ?? '' }}">

                            <div>
                                <label class="block text-xs font-semibold text-gray-400 mb-1.5 uppercase tracking-wider">Rating Anda</label>
                                <select name="rating" required class="w-full bg-slate-800 text-white border border-gray-700 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-amber-500 transition">
                                    <option value="5">⭐⭐⭐⭐⭐ 5 (Sangat Bagus)</option>
                                    <option value="4">⭐⭐⭐⭐ 4 (Bagus)</option>
                                    <option value="3">⭐⭐⭐ 3 (Cukup)</option>
                                    <option value="2">⭐⭐ 2 (Buruk)</option>
                                    <option value="1">⭐ 1 (Sangat Buruk)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-400 mb-1.5 uppercase tracking-wider">Ulasan / Pendapat</label>
                                <textarea name="review" rows="3" required placeholder="Tulis pendapatmu tentang film ini..." 
                                        class="w-full bg-slate-800 text-white border border-gray-700 rounded-xl p-3 text-sm placeholder-gray-500 focus:outline-none focus:border-amber-500 transition"></textarea>
                            </div>

                            <button type="submit" class="w-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-sm py-2.5 rounded-xl shadow transition duration-200">
                                Simpan Review
                            </button>
                        </form>
                    </div>

                </div>
            </div>

                        <div class="mt-14">

    <h2 class="text-2xl font-bold text-white mb-6">
        ⭐ Ulasan Pengguna ({{ $reviews->count() }})
    </h2>

    <div class="space-y-5">
        @forelse($reviews as $review)

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-cyan-500 flex items-center justify-center font-bold text-white">
                        {{ strtoupper(substr($review->user->name,0,1)) }}
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-white font-semibold">
                                    {{ $review->user->name }}
                                </h3>
                                <p class="text-xs text-gray-500">
                                    {{ $review->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <div class="text-yellow-400">
                                @for($i=1;$i<=5;$i++)

                                    {!! $i <= $review->rating ? '⭐' : '☆' !!}

                                @endfor
                            </div>
                        </div>
                        <p class="mt-4 text-gray-300 leading-7">
                            {{ $review->review }}
                        </p>
                    </div>
                </div>
            </div>
        @empty

            <div class="bg-slate-900 rounded-2xl p-8 text-center">
                <div class="text-5xl mb-3">
                    💬
                </div>
                <h3 class="text-white font-semibold text-lg">
                    Belum ada review
                </h3>
                <p class="text-gray-400 mt-2">
                    Jadilah orang pertama yang memberikan review.
                </p>
            </div>

        @endforelse
    </div>
</div>
        @else
            <div class="bg-slate-900/60 border border-gray-800 rounded-2xl p-12 text-center">
                <p class="text-gray-400 text-sm">Data film tidak ditemukan.</p>
            </div>
        @endif
    </main>
</x-app-layout>