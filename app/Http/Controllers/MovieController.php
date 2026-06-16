<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Models\Watchlist;
use App\Models\Review;

class MovieController extends Controller
{
    /**
     * Dashboard
     */
    public function index()
    {
        $token = config('services.tmdb.token');

        $response = Http::withoutVerifying()
            ->withToken($token)
            ->get('https://api.themoviedb.org/3/trending/movie/day');

        if ($response->failed()) {

            Log::error(
                'TMDB API Error Index: ' .
                $response->body()
            );

            $trendingMovies = [];

        } else {

            $trendingMovies =
                $response->json()['results'] ?? [];
        }

        $watchlistCount = Watchlist::where(
            'user_id',
            auth()->id()
        )->count();

        $reviewCount = Review::where(
            'user_id',
            auth()->id()
        )->count();

        return view(
            'movies.index',
            compact(
                'trendingMovies',
                'watchlistCount',
                'reviewCount'
            )
        );
    }

    /**
     * Search Movie
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $searchResult = [];

        $token = config('services.tmdb.token');

        if ($query) {

            $response = Http::withoutVerifying()
                ->withToken($token)
                ->get(
                    'https://api.themoviedb.org/3/search/movie',
                    [
                        'query' => $query
                    ]
                );

            if ($response->failed()) {

                Log::error(
                    'TMDB API Error Search: ' .
                    $response->body()
                );

            } else {

                $searchResult =
                    $response->json()['results'] ?? [];
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
        $token = config('services.tmdb.token');

        $movieResponse = Http::withoutVerifying()
            ->withToken($token)
            ->get(
                "https://api.themoviedb.org/3/movie/{$id}"
            );

        $creditsResponse = Http::withoutVerifying()
            ->withToken($token)
            ->get(
                "https://api.themoviedb.org/3/movie/{$id}/credits"
            );

        if ($movieResponse->failed()) {

            Log::error(
                "TMDB API Error Show (ID: {$id}): "
                . $movieResponse->body()
            );

            abort(404, 'Film tidak ditemukan');
        }

        $movie = $movieResponse->json();

        $actors = array_slice(
            $creditsResponse->json()['cast'] ?? [],
            0,
            5
        );

        return view(
            'movies.show',
            compact(
                'movie',
                'actors'
            )
        );
    }
}