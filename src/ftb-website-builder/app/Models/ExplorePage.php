<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class ExplorePage extends Model
{
    /**
     * Get the property that owns the explore page.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the attractions for the explore page.
     */
    public function attractions(): HasMany
    {
        return $this->hasMany(Attraction::class);
    }
}
