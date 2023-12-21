<?php

namespace App\Models\FindUsPage;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FindUsPage extends Model
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
        'find_us_page_section_header' => 'string',
        'find_us_page_section_paragraph' => 'string',
        'find_us_page_section_image' => 'string',
        'find_us_page_section_image_description' => 'string',
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
     * Get the property that owns the find us page.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the directions for the find us page.
     */
    public function directions(): HasMany
    {
        return $this->hasMany(Direction::class, 'property_id');
    }
}
