<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    /**
     * Get the property that owns the about page.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the secondary cover images for the home page.
     */
    public function secondaryCoverImages(): HasMany
    {
        return $this->hasMany(SecondaryCoverImage::class);
    }
}
