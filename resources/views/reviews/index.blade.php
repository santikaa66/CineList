<x-app-layout>

    <div class="max-w-7xl mx-auto py-10 px-4">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800">
                ⭐ My Reviews
            </h1>

            <p class="text-gray-500 mt-2">
                Bagikan pendapatmu tentang film favoritmu.
            </p>
        </div>

        <!-- Form Review -->
        <div class="bg-white rounded-2xl shadow-md p-6 mb-8">

            <h2 class="text-xl font-bold mb-4">
                ✍️ Tulis Review Baru
            </h2>

            <form action="{{ route('reviews.store') }}" method="POST">

                @csrf

                <div class="grid md:grid-cols-2 gap-4">

                    <div>
                        <label class="block font-semibold mb-2">
                            Movie ID
                        </label>

                        <input
                            type="number"
                            name="movie_id"
                            class="w-full border rounded-lg p-3"
                            required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Rating (1-5)
                        </label>

                        <input
                            type="number"
                            min="1"
                            max="5"
                            name="rating"
                            class="w-full border rounded-lg p-3"
                            required>
                    </div>

                </div>

                <div class="mt-4">

                    <label class="block font-semibold mb-2">
                        Review
                    </label>

                    <textarea
                        name="review"
                        rows="4"
                        class="w-full border rounded-lg p-3"
                        placeholder="Tulis ulasan film..."
                        required></textarea>

                </div>

                <button
                    type="submit"
                    class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                    ⭐ Simpan Review
                </button>

            </form>

        </div>

        <!-- Daftar Review -->
        <div class="space-y-6">

            @forelse($reviews as $item)

                <div class="bg-white rounded-2xl shadow-md p-6">

                    <div class="flex justify-between items-start">

                        <div>

                            <h3 class="text-lg font-bold text-gray-800">
                                🎬 Movie ID: {{ $item->movie_id }}
                            </h3>

                            <div class="mt-2">

                                @for($i = 1; $i <= 5; $i++)

                                    @if($i <= $item->rating)
                                        <span class="text-yellow-500 text-xl">★</span>
                                    @else
                                        <span class="text-gray-300 text-xl">★</span>
                                    @endif

                                @endfor

                            </div>

                        </div>

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $item->rating }}/5
                        </span>

                    </div>

                    <p class="mt-4 text-gray-700 leading-relaxed">
                        {{ $item->review }}
                    </p>

                    <form
                        action="{{ route('reviews.destroy', $item->id) }}"
                        method="POST"
                        class="mt-5">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold transition">
                            🗑 Hapus Review
                        </button>

                    </form>

                </div>

            @empty

                <div class="bg-white rounded-2xl shadow-md p-10 text-center">

                    <div class="text-6xl mb-4">
                        ⭐
                    </div>

                    <h2 class="text-2xl font-bold text-gray-700">
                        Belum Ada Review
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Tulis review pertamamu sekarang.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</x-app-layout>