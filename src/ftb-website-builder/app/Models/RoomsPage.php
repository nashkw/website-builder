<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomsPage extends Model
{
    /**
     * Get the property that owns the rooms page.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the rooms for the rooms page.
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
}