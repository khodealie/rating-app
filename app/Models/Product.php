<?php

namespace App\Models;

use App\Enums\RatingAccess;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id', 'name', 'description', 'is_enabled',
        'vote_enabled', 'comment_enabled', 'rating_access'
    ];

    protected $casts = [
        'rating_access' => RatingAccess::class,
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function lastThreeComments(): HasMany
    {
        return $this->hasMany(Comment::class)
            ->where('is_approved', true)
            ->latest()
            ->limit(3);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }
}
