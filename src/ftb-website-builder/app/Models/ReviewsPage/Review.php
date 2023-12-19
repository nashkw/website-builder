<?php

namespace App\Models\ReviewsPage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'review_id' => 'integer',
        'property_id' => 'integer',
        'review_quote' => 'string',
        'reviewer_name' => 'string',
        'star_rating' => 'string',
        'review_date' => 'string',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'property_id',
    ];
    /**
     * Get the reviews page that owns the review.
     */
    public function reviewsPage(): BelongsTo
    {
        return $this->belongsTo(ReviewsPage::class, 'property_id', 'property_id');
    }
}
