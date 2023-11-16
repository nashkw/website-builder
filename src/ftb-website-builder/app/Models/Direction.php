<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Direction extends Model
{
    /**
     * Get the find us page that owns the direction.
     */
    public function findUsPage(): BelongsTo
    {
        return $this->belongsTo(FindUsPage::class);
    }
}
