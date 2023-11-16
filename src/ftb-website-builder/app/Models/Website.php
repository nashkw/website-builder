<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    /**
     * Get the property that owns the website.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
