<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [MovieController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/search', [MovieController::class, 'search'])
    ->middleware(['auth'])
    ->name('movie.search');

Route::get('/movie/{id}', [MovieController::class, 'show'])
    ->middleware(['auth'])
    ->name('movie.show');

Route::middleware('auth')->group(function () {

    // PROFILE (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // WATCHLIST
    Route::get('/watchlist', [WatchlistController::class, 'index'])
        ->name('watchlist.index');

    Route::post('/watchlist', [WatchlistController::class, 'store'])
        ->name('watchlist.store');

    Route::delete('/watchlist/{watchlist}', [WatchlistController::class, 'destroy'])
        ->name('watchlist.destroy');


    //RIVIEW
    Route::get('/reviews', [ReviewController::class, 'index'])
    ->name('reviews.index');

    Route::post('/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');

    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
        ->name('reviews.destroy');

    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])
    ->name('reviews.edit');

    Route::put('/reviews/{review}', [ReviewController::class, 'update'])
        ->name('reviews.update');
});

require __DIR__.'/auth.php';