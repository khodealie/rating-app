<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'comment', 'is_approved'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
