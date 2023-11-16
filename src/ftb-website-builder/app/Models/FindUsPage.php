<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FindUsPage extends Model
{
    /**
     * Get the property that owns the find us page.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the directions for the find us page.
     */
    public function directions(): HasMany
    {
        return $this->hasMany(Direction::class);
    }
}