<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class SecondaryAboutSection extends Model
{
    /**
     * Get the about page that owns the secondary about section.
     */
    public function aboutPage(): BelongsTo
    {
        return $this->belongsTo(AboutPage::class);
    }
}
