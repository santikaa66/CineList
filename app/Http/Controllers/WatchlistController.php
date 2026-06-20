<?php

namespace App\Http\Controllers;

use App\Models\Watchlist;
use Illuminate\Http\Request;

class WatchlistController extends Controller
{
    public function index()
    {
        $watchlists = Watchlist::where(
            'user_id',
            auth()->id()
        )->latest()->get();

        return view(
            'watchlist.index',
            compact('watchlists')
        );
    }

    public function store(Request $request)
{
        Watchlist::create([
            'user_id' => auth()->id(),
            'movie_id' => $request->movie_id,
            'title' => $request->title,
            'poster' => $request->poster,
        ]);

        return back()->with(
            'success',
            'Film berhasil ditambahkan ke Watchlist!'
        );
    }

    public function destroy(Watchlist $watchlist)
    {
        $watchlist->delete();

        return back()->with(
            'success',
            'Film berhasil dihapus dari Watchlist!'
        );
    }
}