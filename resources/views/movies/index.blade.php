<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cinelist Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-slate-900 to-indigo-950 overflow-hidden shadow-sm sm:rounded-lg text-center p-12 relative" style="background-image: linear-gradient(rgba(15, 15, 20, 0.75), rgba(15, 15, 20, 0.95)), url('https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?w=1600'); background-size: cover; background-position: center;">
                <div class="relative z-10">
                    <h1 class="text-4xl font-extrabold text-white mb-2">Track Your Cinema Journey</h1>
                    <p class="text-gray-300 mb-8 max-w-md mx-auto text-sm">Urus daftar tontonanmu, simpan film favorit, dan temukan rekomendasi terbaik berikutnya di sini.</p>
                    
                    <form action="{{ route('movie.search') }}" method="GET" class="flex max-w-md mx-auto bg-slate-800/80 backdrop-blur border border-gray-700 rounded-full p-1.5 shadow-lg">
                        <input type="text" name="query" placeholder="Cari judul film..." required class="flex-1 bg-transparent border-none text-white text-sm px-4 py-2 focus:ring-0 outline-none placeholder-gray-400">
                        <button type="submit" class="hover:bg-indigo-700 text-white font-semibold text-sm px-6 py-2 rounded-full transition-colors" style="background-color: #6c5ce7;">
                            Cari
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 border-b border-gray-200 dark:border-gray-700 pb-3">
                <span class="text-lg font-bold text-gray-800 dark:text-gray-200 border-b-2 border-indigo-500 pb-3">Trending Now</span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @forelse($trendingMovies ?? [] as $movie)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden flex flex-col transform hover:-translate-y-1 transition-transform duration-300 border border-gray-100 dark:border-gray-700">
                        <a href="{{ route('movie.show', $movie['id']) }}" class="relative block aspect-[2/3] bg-gray-900">
                            @if(!empty($movie['poster_path']))
                                <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] ?? 'Movie' }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-500 text-xs">No Poster</div>
                            @endif
                            <div class="absolute top-3 left-3 bg-black/70 backdrop-blur px-2 py-1 rounded-md text-xs font-bold text-yellow-400 flex items-center gap-1">
                                <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                {{ number_format($movie['vote_average'] ?? 0, 1) }}
                            </div>
                        </a>

                        <div class="p-4 flex flex-col flex-1 justify-between">
                            <div>
                                <a href="{{ route('movie.show', $movie['id']) }}" class="block group">
                                    <h3 class="font-bold text-sm text-gray-900 dark:text-white line-clamp-1 group-hover:text-indigo-500 transition-colors">{{ $movie['title'] ?? 'Untitled' }}</h3>
                                </a>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Release: {{ isset($movie['release_date']) ? date('Y', strtotime($movie['release_date'])) : 'N/A' }}</p>
                            </div>

                            <button onclick="toggleWatchlist(this)" class="mt-4 w-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-white text-xs font-semibold py-2 px-3 rounded-lg transition-colors flex items-center justify-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Watchlist
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 bg-white dark:bg-gray-800 rounded-xl border border-gray-150 dark:border-gray-700 shadow-sm">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16M17 4v16M3 8h18M3 16h18" />
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Tidak ada film trending saat ini atau koneksi API terputus.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        function toggleWatchlist(button) {
            const isAdded = button.classList.contains('added');
            if (!isAdded) {
                button.classList.add('added');
                button.innerHTML = '✓ Added';
                button.style.backgroundColor = '#10B981';
                button.style.color = '#FFFFFF';
            } else {
                button.classList.remove('added');
                button.innerHTML = '+ Watchlist';
                button.style.backgroundColor = '';
                button.style.color = '';
            }
        }
    </script>
</x-app-layout>