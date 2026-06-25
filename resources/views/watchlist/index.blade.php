<x-app-layout>

    <main class="max-w-7xl mx-auto py-10 px-4 min-h-screen">

        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white">
                🎬 My Watchlist
            </h1>

            <p class="text-gray-400 mt-2">
                Daftar film yang ingin kamu tonton.
            </p>
        </div>

        @if(session('success'))
            <div class="bg-teal-900/40 border border-teal-500/50 text-teal-300 px-4 py-3 rounded-xl mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @forelse($watchlists as $movie)

                <div class="bg-slate-900/40 border border-gray-800/80 rounded-2xl shadow-lg overflow-hidden flex flex-col justify-between group transition duration-300 hover:border-gray-700">

                    @if($movie->poster)
                        <img
                            src="{{ $movie->poster }}"
                            alt="{{ $movie->title }}"
                            class="w-full h-80 object-cover"
                        >
                    @else
                        <div class="w-full h-80 bg-slate-800 flex items-center justify-center text-gray-500">
                            <span>
                                No Poster
                            </span>
                        </div>
                    @endif

                    <div class="p-4 flex-1 flex flex-col justify-between space-y-3">

                        <div>
                            <h2 class="font-bold text-base text-white line-clamp-1 group-hover:text-teal-400 transition duration-150">
                                {{ $movie->title }}
                            </h2>

                            <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                📌 Disimpan dalam watchlist
                            </p>
                        </div>

                        <form
                            action="{{ route('watchlist.destroy', $movie->id) }}"
                            method="POST"
                            class="m-0"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="w-full bg-red-600/90 hover:bg-red-500 text-white py-2 rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5"
                            >
                                🗑️ Hapus
                            </button>
                        </form>

                    </div>

                </div>

            @empty

                <div class="col-span-full">

                    <div class="bg-slate-900/40 border border-gray-800/80 rounded-2xl shadow-md p-12 text-center">

                        <div class="text-6xl mb-4">
                            🎬
                        </div>

                        <h2 class="text-2xl font-bold text-white">
                            Watchlist Masih Kosong
                        </h2>

                        <p class="text-gray-400 mt-2 text-sm">
                            Tambahkan film favoritmu ke watchlist.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </main>

</x-app-layout>