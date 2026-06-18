<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::where(
            'user_id',
            auth()->id()
        )->latest()->get();

        return view(
            'reviews.index',
            compact('reviews')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required',
            'title' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required',
        ]);


        Review::create([
            'user_id' => auth()->id(),
            'movie_id' => $request->movie_id,
            'title' => $request->title,
            'poster' => $request->poster,
            'rating' => $request->rating,
            'review' => $request->review,
]);

        return back()->with('success', 'Review berhasil ditambahkan!');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return back()->with('success', 'Review berhasil dihapus!');
    }
}