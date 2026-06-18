<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
    'user_id',
    'movie_id',
    'title',
    'poster',
    'rating',
    'review',
];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}