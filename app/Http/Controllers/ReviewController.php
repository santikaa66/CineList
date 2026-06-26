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

    public function edit(Review $review)
{
    // Pastikan hanya pemilik review yang bisa mengedit
    if ($review->user_id != auth()->id()) {
        abort(403);
    }

    return view('reviews.edit', compact('review'));
}

    public function update(Request $request, Review $review)
    {
        // Pastikan hanya pemilik review yang bisa mengedit
        if ($review->user_id != auth()->id()) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        $review->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()
            ->route('reviews.index')
            ->with('success', 'Review berhasil diperbarui.');
    }
}