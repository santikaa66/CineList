<x-app-layout>

<div class="max-w-3xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold text-white mb-8">
        ✏ Edit Review
    </h1>

    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">

        <div class="flex gap-5 mb-6">

            <img
                src="{{ $review->poster }}"
                class="w-28 h-40 rounded-xl object-cover"
            >

            <div>
                <h2 class="text-2xl font-bold text-white">
                    {{ $review->title }}
                </h2>
                <p class="text-gray-400 mt-2">
                    Ubah rating dan review film.
                </p>
            </div>

        </div>

        <form action="{{ route('reviews.update', $review->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="text-white font-semibold">Rating</label>

            <select name="rating"
                class="w-full mt-2 bg-slate-800 border border-slate-700 rounded-xl p-3 text-white">

                @for($i=1;$i<=5;$i++)
                    <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
                        {{ $i }} ⭐
                    </option>
                @endfor

            </select>

            <label class="text-white font-semibold mt-5 block">Review</label>

            <textarea name="review"
                rows="5"
                class="w-full mt-2 bg-slate-800 border border-slate-700 rounded-xl p-3 text-white">
                {{ $review->review }}
            </textarea>

            <div class="flex gap-3 mt-6">

                <button class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-xl text-white font-semibold">
                    💾 Update
                </button>

                <a href="{{ route('reviews.index') }}"
                   class="bg-slate-700 hover:bg-slate-600 px-6 py-3 rounded-xl text-white">
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

</x-app-layout>