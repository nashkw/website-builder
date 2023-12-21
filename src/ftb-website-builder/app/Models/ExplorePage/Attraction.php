<?php

namespace App\Models\ExplorePage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attraction extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'property_id' => 'integer',
        'attraction_header' => 'string',
        'attraction_paragraph' => 'string',
        'attraction_image' => 'string',
        'attraction_image_description' => 'string',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'property_id',
    ];
    /**
     * Get the explore page that owns the attraction.
     */
    public function explorePage(): BelongsTo
    {
        return $this->belongsTo(ExplorePage::class, 'property_id', 'property_id');
    }
}
