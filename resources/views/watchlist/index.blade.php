<x-app-layout>

    <div class="max-w-7xl mx-auto py-10 px-4">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800">
                🎬 My Watchlist
            </h1>

            <p class="text-gray-500 mt-2">
                Daftar film yang ingin kamu tonton.
            </p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @forelse($watchlists as $movie)

                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">

                    <!-- Poster -->
                    @if($movie->poster)
                        <img
                            src="{{ $movie->poster }}"
                            alt="{{ $movie->title }}"
                            class="w-full h-80 object-cover"
                        >
                    @else
                        <div class="w-full h-80 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">
                                No Poster
                            </span>
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="p-4">

                        <h2 class="font-bold text-lg text-gray-800 line-clamp-2">
                            {{ $movie->title }}
                        </h2>

                        <p class="text-sm text-gray-500 mt-2">
                            📌 Disimpan dalam watchlist
                        </p>

                        <form
                            action="{{ route('watchlist.destroy', $movie->id) }}"
                            method="POST"
                            class="mt-4"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg font-semibold transition"
                            >
                                🗑 Hapus
                            </button>
                        </form>

                    </div>

                </div>

            @empty

                <div class="col-span-full">

                    <div class="bg-white rounded-2xl shadow-md p-10 text-center">

                        <div class="text-6xl mb-4">
                            🎬
                        </div>

                        <h2 class="text-2xl font-bold text-gray-700">
                            Watchlist Masih Kosong
                        </h2>

                        <p class="text-gray-500 mt-2">
                            Tambahkan film favoritmu ke watchlist.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</x-app-layout>