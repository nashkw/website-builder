<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
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
        'cover_image_primary' => 'string',
        'cover_image_primary_description' => 'string',
        'intro_section_header' => 'string',
        'intro_section_paragraph' => 'string',
        'intro_section_image' => 'string',
        'intro_section_image_description' => 'string',
        'welcome_section_header' => 'string',
        'welcome_section_paragraph' => 'string',
        'welcome_section_image' => 'string',
        'welcome_section_image_description' => 'string',
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
     * Get the property that owns the about page.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the secondary cover images for the home page.
     */
    public function secondaryCoverImages(): HasMany
    {
        return $this->hasMany(SecondaryCoverImage::class, 'property_id');
    }
}
