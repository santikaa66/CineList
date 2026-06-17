<x-app-layout>

    <div class="max-w-5xl mx-auto py-8">

        <h1 class="text-3xl font-bold mb-6">
            ⭐ My Reviews
        </h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Form Review --}}
        <div class="bg-[#0f172a] border-b border-slate-800">

            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Movie ID
                    </label>

                    <input
                        type="number"
                        name="movie_id"
                        class="w-full border rounded-lg p-2"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Movie Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="w-full border rounded-lg p-2"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Rating (1-5)
                    </label>

                    <input
                        type="number"
                        min="1"
                        max="5"
                        name="rating"
                        class="w-full border rounded-lg p-2"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Review
                    </label>

                    <textarea
                        name="review"
                        rows="4"
                        class="w-full border rounded-lg p-2"
                        required></textarea>
                </div>

                <button
                    type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg">
                    Simpan Review
                </button>

            </form>

        </div>

        {{-- List Review --}}
        @forelse($reviews as $item)

            <div class="bg-white p-6 rounded-xl shadow mb-4">

                <h2 class="font-bold text-xl">
                    🎬 {{ $item->title }}
                </h2>

                <p class="text-yellow-500 font-semibold mt-2">
                    ⭐ {{ $item->rating }}/5
                </p>

                <p class="text-gray-700 mt-3">
                    {{ $item->review }}
                </p>

                <form
                    action="{{ route('reviews.destroy', $item->id) }}"
                    method="POST"
                    class="mt-4">

                    @csrf
                    @method('DELETE')

                    <button
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                        Hapus
                    </button>

                </form>

            </div>

        @empty

            <div class="bg-white p-6 rounded-xl shadow text-center">
                Belum ada review.
            </div>

        @endforelse

    </div>

</x-app-layout>