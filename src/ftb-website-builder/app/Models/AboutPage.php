<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    /**
     * Get the property that owns the about page.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the secondary about sections for the about page.
     */
    public function secondaryAboutSections(): HasMany
    {
        return $this->hasMany(SecondaryAboutSection::class);
    }
}
