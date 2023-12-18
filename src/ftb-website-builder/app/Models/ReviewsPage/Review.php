<?php

namespace App\Models\ReviewsPage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
