<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎬 CineList Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-8 rounded-2xl shadow-lg">

                <h1 class="text-4xl font-bold">
                    Welcome, {{ Auth::user()->name }} 👋
                </h1>

                <p class="mt-3 text-indigo-100 text-lg">
                    Track your favorite movies, manage your watchlist,
                    and share reviews with CineList.
                </p>

            </div>

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">

                <!-- Watchlist -->
                <div class="bg-white rounded-2xl shadow-md p-6">

                    <h3 class="text-lg font-semibold text-gray-700">
                        📌 Watchlist
                    </h3>

                    <p class="text-5xl font-bold text-indigo-600 mt-4">
                        {{ $watchlistCount }}
                    </p>

                    <p class="text-gray-500 mt-2">
                        Movies saved to your watchlist
                    </p>

                </div>

                <!-- Reviews -->
                <div class="bg-white rounded-2xl shadow-md p-6">

                    <h3 class="text-lg font-semibold text-gray-700">
                        ⭐ Reviews
                    </h3>

                    <p class="text-5xl font-bold text-yellow-500 mt-4">
                        {{ $reviewCount }}
                    </p>

                    <p class="text-gray-500 mt-2">
                        Reviews you've written
                    </p>

                </div>

            </div>

            <!-- Quick Access -->
            <div class="bg-white rounded-2xl shadow-md p-6 mt-8">

                <h3 class="text-xl font-bold text-gray-800 mb-5">
                    🚀 Quick Access
                </h3>

                <div class="flex flex-wrap gap-4">

                    <a href="{{ route('watchlist.index') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                        📌 My Watchlist
                    </a>

                    <a href="{{ route('reviews.index') }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                        ⭐ My Reviews
                    </a>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>