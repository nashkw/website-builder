<?php

namespace App\Models\ExplorePage;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExplorePage extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'property_id';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'property_id' => 'integer',
        'meta_page_title' => 'string',
        'meta_page_description' => 'string',
        'explore_page_section_header' => 'string',
        'explore_page_section_paragraph' => 'string',
        'explore_page_section_image' => 'string',
        'explore_page_section_image_description' => 'string',
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
     * Get the property that owns the explore page.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the attractions for the explore page.
     */
    public function attractions(): HasMany
    {
        return $this->hasMany(Attraction::class, 'property_id');
    }
}
