<x-app-layout>

    <main class="max-w-7xl mx-auto px-6 py-10 min-h-screen">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div>

                <h1 class="text-4xl font-bold text-white">
                    🎬 My Watchlists
                </h1>

                <p class="text-gray-400 mt-2">
                    Simpan film favoritmu untuk ditonton nanti.
                </p>

            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-2xl px-6 py-4 text-center">

                <i class="fa-solid fa-film text-cyan-400 text-2xl"></i>

                <p class="text-3xl font-bold text-white mt-2">
                    {{ $watchlists->count() }}
                </p>

                <p class="text-gray-400 text-sm">
                    Movies Saved
                </p>

            </div>

        </div>

        {{-- Success Message --}}
        @if(session('success'))

            <div class="mb-6 bg-emerald-500/10 border border-emerald-500 text-emerald-400 px-5 py-3 rounded-xl">

                {{ session('success') }}

            </div>

        @endif

        {{-- Movie Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">

            @forelse($watchlists as $movie)

                <div class="group cursor-pointer bg-slate-900 rounded-2xl overflow-hidden border border-slate-800 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:border-cyan-500 hover:shadow-cyan-500/20">

                    <div class="relative overflow-hidden">

                        {{-- Poster --}}
                        <a href="{{ route('movie.show', $movie->movie_id) }}">

                            @if($movie->poster)

                                <img
                                    src="{{ $movie->poster }}"
                                    alt="{{ $movie->title }}"
                                    class="w-full h-80 object-cover transition duration-500 group-hover:scale-110 group-hover:brightness-75">

                            @else

                                <div class="w-full h-80 bg-slate-800 flex items-center justify-center text-gray-500">

                                    No Poster

                                </div>

                            @endif

                        </a>

                        {{-- Tombol Hapus --}}
                        <form
                            action="{{ route('watchlist.destroy', $movie->id) }}"
                            method="POST"
                            class="absolute top-3 right-3 opacity-100 md:opacity-0 md:group-hover:opacity-100 transition duration-300">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus film ini dari watchlist?')"
                                class="w-10 h-10 rounded-full bg-red-600 hover:bg-red-500 text-white shadow-lg flex items-center justify-center transition">

                                🗑️

                            </button>

                        </form>

                    </div>

                    <div class="p-4">

                        {{-- Judul --}}
                        <a href="{{ route('movie.show', $movie->movie_id) }}">

                            <h2 class="mt-1 text-white font-semibold line-clamp-2 hover:text-cyan-400 transition">

                                {{ $movie->title }}

                            </h2>

                        </a>

                        <p class="text-xs text-gray-500 mt-2 flex items-center gap-2">

                            <i class="fa-solid fa-bookmark text-cyan-400"></i>

                            Watchlist

                        </p>

                    </div>

                </div>

            @empty

                <div class="col-span-full">

                    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-16 text-center">

                        <div class="text-7xl mb-5">

                            🎬

                        </div>

                        <h2 class="text-3xl font-bold text-white">

                            Watchlist Masih Kosong

                        </h2>

                        <p class="text-gray-400 mt-3">

                            Mulai tambahkan film favoritmu ke watchlist agar mudah ditemukan nanti.

                        </p>

                        <a
                            href="{{ route('dashboard') }}"
                            class="inline-flex items-center gap-2 mt-8 bg-cyan-600 hover:bg-cyan-500 text-white px-6 py-3 rounded-xl font-semibold transition">

                            <i class="fa-solid fa-film"></i>

                            Jelajahi Film

                        </a>

                    </div>

                </div>

            @endforelse

        </div>

    </main>

</x-app-layout>