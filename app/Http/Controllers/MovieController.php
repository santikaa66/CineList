<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    /**
     * Dashboard
     */
    public function index()
    {
        $trendingMovies = [];

        try {

            $token = config('services.tmdb.token');

            $page1 = Http::withoutVerifying()
                ->withToken($token)
                ->get(
                    'https://api.themoviedb.org/3/trending/movie/day',
                    ['page' => 1]
                );

            $page2 = Http::withoutVerifying()
                ->withToken($token)
                ->get(
                    'https://api.themoviedb.org/3/trending/movie/day',
                    ['page' => 2]
                );

            if ($page1->successful() && $page2->successful()) {

                $trendingMovies = array_merge(
                    $page1->json()['results'] ?? [],
                    $page2->json()['results'] ?? []
                );
            }

        } catch (\Exception $e) {

            Log::error(
                'TMDB Dashboard Error: ' .
                $e->getMessage()
            );
        }

        $watchlists = Watchlist::where(
            'user_id',
            auth()->id()
        )
        ->latest()
        ->take(10)
        ->get();

        $latestReviews = Review::where(
            'user_id',
            auth()->id()
        )
        ->latest()
        ->take(6)
        ->get();

        return view(
            'movies.index',
            [
                'trendingMovies' => $trendingMovies,
                'watchlists' => $watchlists,
                'latestReviews' => $latestReviews,
                'watchlistCount' => $watchlists->count(),
                'reviewCount' => $latestReviews->count(),
            ]
        );
    }

    /**
     * Search Movie
     */
    public function search(Request $request)
    {
        $query = $request->query('query');
        $searchResult = [];

        if ($query) {

            try {

                $response = Http::withoutVerifying()
                    ->withToken(config('services.tmdb.token'))
                    ->get(
                        'https://api.themoviedb.org/3/search/movie',
                        [
                            'query' => $query,
                            'page' => 1
                        ]
                    );

                if ($response->successful()) {

                    $searchResult =
                        $response->json()['results'] ?? [];
                }

            } catch (\Exception $e) {

                Log::error(
                    'TMDB Search Error: ' .
                    $e->getMessage()
                );
            }
        }

        return view(
            'movies.search',
            compact(
                'searchResult',
                'query'
            )
        );
    }

    /**
     * Detail Movie
     */
    public function show($id)
{
            try {

                $token = config('services.tmdb.token');

                $movieResponse = Http::withoutVerifying()
                    ->withToken($token)
                    ->get(
                        "https://api.themoviedb.org/3/movie/{$id}"
                    );

                $videoResponse = Http::withoutVerifying()
                    ->withToken($token)
                    ->get(
                        "https://api.themoviedb.org/3/movie/{$id}/videos"
                    );

                $creditsResponse = Http::withoutVerifying()
                    ->withToken($token)
                    ->get(
                        "https://api.themoviedb.org/3/movie/{$id}/credits"
                    );

                if ($movieResponse->failed()) {
                    abort(404, 'Film tidak ditemukan');
                }

                $movie = $movieResponse->json();

                $trailer = collect(
                    $videoResponse->json()['results'] ?? []
                )->firstWhere('type', 'Trailer');

                $actors = array_slice(
                    $creditsResponse->json()['cast'] ?? [],
                    0,
                    5
                );

                // Review dari user CineList
                $reviews = Review::with('user')
                    ->where('movie_id', $id)
                    ->latest()
                    ->get();
                    
                // Cek apakah film ini sudah ada di watchlist user yang sedang login
                $isInWatchlist = auth()->user()
                    ? \App\Models\Watchlist::where('user_id', auth()->id())->where('movie_id', $id)->exists()
                    : false;

                return view(
                    'movies.show',
                    compact(
                        'movie',
                        'actors',
                        'trailer',
                        'reviews'
                    )
                );

            } catch (\Exception $e) {

                Log::error(
                    "TMDB Detail Error ({$id}): " .
                    $e->getMessage()
                );

                abort(404, 'Film tidak ditemukan');
            }
        }
}