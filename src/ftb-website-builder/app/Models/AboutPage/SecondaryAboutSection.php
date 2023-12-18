<?php

namespace App\Models\AboutPage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SecondaryAboutSection extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'secondary_about_section_id' => 'integer',
        'property_id' => 'integer',
        'secondary_about_section_header' => 'string',
        'secondary_about_section_paragraph' => 'string',
        'secondary_about_section_image' => 'string',
        'secondary_about_section_image_description' => 'string',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'secondary_about_section_id',
        'property_id',
    ];

    /**
     * Get the about page that owns the secondary about section.
     */
    public function aboutPage(): BelongsTo
    {
        return $this->belongsTo(AboutPage::class);
    }
}
