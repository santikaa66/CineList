<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Log; // Untuk mencatat error jika ada masalah

class MovieController extends Controller
{
    /**
     * Menampilkan Kategori Tren (Halaman Utama / Dashboard)
     */
    public function index()
    {
        // Mendapatkan token langsung dari konfigurasi services
        $token = config('services.tmdb.token');

        // Menggunakan Http::withoutVerifying() untuk melewati proteksi SSL lokal yang sering memblokir API
        $response = Http::withoutVerifying()
            ->withToken($token)
            ->get('https://api.themoviedb.org/3/trending/movie/day');

        if ($response->failed()) {
            // Jika gagal, sistem akan mencatat error di file storage/logs/laravel.log
            Log::error('TMDB API Error Index: ' . $response->body());
            $trendingMovies = [];
        } else {
            $trendingMovies = $response->json()['results'] ?? [];
        }

        return view('movies.index', compact('trendingMovies'));
    }

    /**
     * Fitur Pencarian Film (Search)
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $searchResult = [];
        $token = config('services.tmdb.token');

        if ($query) {
            $response = Http::withoutVerifying()
                ->withToken($token)
                ->get('https://api.themoviedb.org/3/search/movie', [
                    'query' => $query
                ]);

            if ($response->failed()) {
                Log::error('TMDB API Error Search: ' . $response->body());
            } else {
                $searchResult = $response->json()['results'] ?? [];
            }
        }

        return view('movies.search', compact('searchResult', 'query'));
    }

    /**
     * Halaman Detail Film (Sinopsis & Daftar Pemain)
     */
    public function show($id)
    {
        $token = config('services.tmdb.token');

        $movieResponse = Http::withoutVerifying()
            ->withToken($token)
            ->get("https://api.themoviedb.org/3/movie/{$id}");

        $creditsResponse = Http::withoutVerifying()
            ->withToken($token)
            ->get("https://api.themoviedb.org/3/movie/{$id}/credits");

        if ($movieResponse->failed()) {
            Log::error("TMDB API Error Show (ID: {$id}): " . $movieResponse->body());
            abort(404, 'Film tidak ditemukan di TMDB');
        }

        $movie = $movieResponse->json();
        $actors = array_slice($creditsResponse->json()['cast'] ?? [], 0, 5);

        return view('movies.show', compact('movie', 'actors'));
    }
}