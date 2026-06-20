<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-950">
        <div class="min-h-screen bg-slate-950 text-white">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-[#0f172a] border-b border-slate-800">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            @if(session('success'))
                <div
                    id="toast"
                    class="fixed top-5 right-5 bg-slate-900/95 backdrop-blur-md border border-green-500 text-white px-5 py-4 rounded-xl shadow-2xl z-50 flex items-center gap-3">

                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                        ✓
                    </div>

                    <div>
                        <p class="font-semibold">Berhasil</p>
                        <p class="text-sm text-gray-300">
                            {{ session('success') }}
                        </p>
                    </div>

                </div>

                <script>
                    const toast = document.getElementById('toast');

                    setTimeout(() => {
                        toast.style.transition = 'all .5s ease';
                        toast.style.opacity = '0';
                        toast.style.transform = 'translateX(100%)';

                        setTimeout(() => toast.remove(), 500);
                    }, 2500);
                </script>
                @endif

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
        </div>
    </body>
</html>
