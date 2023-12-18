<?php

namespace App\Models\ExplorePage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
