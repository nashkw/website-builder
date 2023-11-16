<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    /**
     * Get the explore page that owns the attraction.
     */
    public function explorePage(): BelongsTo
    {
        return $this->belongsTo(ExplorePage::class);
    }
}
