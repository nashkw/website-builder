<?php

namespace App\Models\FindUsPage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Direction extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'direction_id' => 'integer',
        'property_id' => 'integer',
        'directions_label' => 'string',
        'directions_paragraph' => 'string',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'property_id',
    ];

    /**
     * Get the find us page that owns the direction.
     */
    public function findUsPage(): BelongsTo
    {
        return $this->belongsTo(FindUsPage::class, 'property_id', 'property_id');
    }
}
