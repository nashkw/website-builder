<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * Get the reviews page that owns the review.
     */
    public function reviewsPage(): BelongsTo
    {
        return $this->belongsTo(ReviewsPage::class);
    }
}
