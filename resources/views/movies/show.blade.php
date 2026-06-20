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
                         class="w-full rounded-2xl shadow-2xl border border-gray-800/80 object-cover">
                </div>

                <div class="flex-1 space-y-6 text-white w-full">
                    
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight leading-tight">
                            {{ $movie['title'] ?? '' }}
                        </h1>
                        <div class="flex items-center gap-3 mt-3 text-sm text-gray-400 font-medium">
                            <span class="text-yellow-400 flex items-center gap-1">
                                <i class="fa-solid fa-star"></i> {{ number_format($movie['vote_average'] ?? 0, 1) }} / 10
                            </span>
                            <span>•</span>
                            <span>{{ $movie['release_date'] ?? 'N/A' }}</span>
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
                                <div class="bg-slate-800/50 text-gray-300 px-4 py-1.5 rounded-full text-xs font-medium border border-gray-700/60 shadow-sm flex items-center gap-1.5">
                                    <i class="fa-solid fa-user text-gray-400"></i> {{ $actor['name'] }}
                                </div>
                            @empty
                                <p class="text-gray-400 text-xs italic">Data pemain tidak tersedia.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="pt-2 max-w-xs">
                        <form action="{{ route('watchlist.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                            <input type="hidden" name="title" value="{{ $movie['title'] }}">
                            <input type="hidden" name="poster" value="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] ?? '' }}">

                            <button type="submit" class="w-full bg-teal-600 hover:bg-teal-500 text-white font-bold text-sm py-3 px-4 rounded-xl shadow-md transition duration-200 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-plus"></i> Add to Watchlist
                            </button>
                        </form>
                    </div>

                    <hr class="border-gray-800/80 my-6">

                    <div class="bg-slate-900/40 border border-gray-800/80 rounded-2xl p-6 max-w-xl shadow-inner">
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
        @else
            <div class="bg-slate-900/60 border border-gray-800 rounded-2xl p-12 text-center">
                <p class="text-gray-400 text-sm">Data film tidak ditemukan.</p>
            </div>
        @endif
    </main>
</x-app-layout>