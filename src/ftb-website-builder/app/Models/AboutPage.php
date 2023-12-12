<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
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
        'about_page_section_header' => 'string',
        'about_page_section_paragraph' => 'string',
        'about_page_section_image' => 'string',
        'about_page_section_image_description' => 'string',
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
     * Get the secondary about sections for the about page.
     */
    public function secondaryAboutSections(): HasMany
    {
        return $this->hasMany(SecondaryAboutSection::class, 'property_id');
    }
}
