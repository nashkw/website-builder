<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class SecondaryCoverImage extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'secondary_cover_image_id' => 'integer',
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
        'secondary_cover_image_id',
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
