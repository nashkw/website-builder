<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class SecondaryCoverImage extends Model
{
    /**
     * Get the home page that owns the secondary cover image.
     */
    public function homePage(): BelongsTo
    {
        return $this->belongsTo(HomePage::class);
    }
}
