<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageFlags extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'property_id';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'property_id' => 'integer',
        'has_home_page' => 'boolean',
        'has_rooms_page' => 'boolean',
        'has_reviews_page' => 'boolean',
        'has_about_page' => 'boolean',
        'has_explore_page' => 'boolean',
        'has_find_us_page' => 'boolean',
        'has_faq_page' => 'boolean',
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
     * Get the property that owns the page flags.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
