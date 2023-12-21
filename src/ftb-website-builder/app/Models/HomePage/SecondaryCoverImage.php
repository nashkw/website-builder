<?php

namespace App\Models\HomePage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SecondaryCoverImage extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'property_id' => 'integer',
        'secondary_cover_image' => 'string',
        'secondary_cover_image_description' => 'string',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'property_id',
    ];

    /**
     * Get the home page that owns the secondary cover image.
     */
    public function homePage(): BelongsTo
    {
        return $this->belongsTo(HomePage::class, 'property_id', 'property_id');
    }
}
