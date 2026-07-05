<x-app-layout>

<div class="max-w-6xl mx-auto px-6 py-10">

    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white">⭐ My Reviews</h1>
        <p class="text-gray-400 mt-2">Semua review film yang pernah kamu tulis.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-600 text-white px-5 py-3 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    @forelse($reviews as $item)

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 mb-6 hover:border-purple-500 transition">

            <div class="flex flex-col md:flex-row gap-6">

                <img
                    src="{{ $item->poster }}"
                    class="w-36 h-52 object-cover rounded-xl shadow-lg"
                >

                <div class="flex-1">

                    <h2 class="text-2xl font-bold text-white">
                        🎬 {{ $item->title }}
                    </h2>

                    <div class="flex items-center gap-1 mt-3 text-yellow-400">
                        @for($i=1;$i<=5;$i++)
                            <span class="{{ $i <= $item->rating ? 'text-yellow-400' : 'text-gray-600' }}">
                                ★
                            </span>
                        @endfor
                        <span class="text-gray-400 text-sm ml-2">
                            {{ $item->rating }}/5
                        </span>
                    </div>

                    <p class="text-gray-400 mt-3">
                        👤 {{ $item->user->name }}
                    </p>

                    <p class="text-gray-500 text-sm mt-1">
                        {{ $item->created_at->format('d F Y') }}
                    </p>

                    <p class="text-gray-300 mt-4 leading-7">
                        {{ $item->review }}
                    </p>

                    <div class="flex gap-3 mt-6">

                        <a href="{{ route('reviews.edit', $item->id) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                            ✏ Edit
                        </a>

                        <form action="{{ route('reviews.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button
                                class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg"
                            >
                                🗑 Hapus
                            </button>

                        </form>

                    </div>

                </div>
            </div>

        </div>

    @empty

        <div class="bg-slate-900 border border-slate-800 rounded-2xl py-14 text-center">
            <div class="text-6xl mb-4">🎬</div>
            <h2 class="text-2xl text-white">Belum Ada Review</h2>
            <p class="text-gray-400 mt-2">Yuk mulai review film favoritmu!</p>
        </div>

    @endforelse

</div>

</x-app-layout>