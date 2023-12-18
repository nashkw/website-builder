<?php

namespace App\Models\ReviewsPage;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReviewsPage extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'property_id';

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
