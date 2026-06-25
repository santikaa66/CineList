<x-app-layout>

    <div class="max-w-5xl mx-auto py-8">

        <h1 class="text-3xl font-bold text-white mb-6">
            ⭐ My Reviews
        </h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        @forelse($reviews as $item)

            <div class="bg-slate-900 rounded-xl p-5 mb-4 border border-slate-800">

                <div class="flex gap-4">

                    <img
                        src="{{ $item->poster }}"
                        alt="{{ $item->title }}"
                        class="w-24 h-36 object-cover rounded-lg">

                    <div class="flex-1">

                        <h2 class="font-bold text-xl text-white">
                            🎬 {{ $item->title }}
                        </h2>

                        <div class="flex items-center justify-between mt-2">

                            <p class="text-gray-400 text-sm">
                                👤 {{ $item->user->name }}
                            </p>

                            <p class="text-gray-500 text-xs">
                                {{ $item->created_at->format('d M Y') }}
                            </p>

                        </div>

                        <div class="mt-3 text-yellow-400 text-lg">

                            @for($i = 1; $i <= 5; $i++)

                                @if($i <= $item->rating)
                                    ⭐
                                @else
                                    ☆
                                @endif

                            @endfor

                        </div>

                        <p class="text-gray-300 mt-3">
                            {{ $item->review }}
                        </p>
                        
                        <form
                            action="{{ route('reviews.destroy', $item->id) }}"
                            method="POST"
                            class="mt-4">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">

                                Hapus Review

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="bg-slate-900 rounded-xl p-6 text-center text-gray-400">
                Belum ada review.
            </div>

        @endforelse

    </div>

</x-app-layout>