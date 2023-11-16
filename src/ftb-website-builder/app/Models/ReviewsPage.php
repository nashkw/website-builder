<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class ReviewsPage extends Model
{
    /**
     * Get the property that owns the reviews page.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the reviews for the reviews page.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}