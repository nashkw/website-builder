<?php

namespace App\Models\RoomsPage;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomsPage extends Model
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
        'rooms_page_section_header' => 'string',
        'rooms_page_section_paragraph' => 'string',
        'rooms_page_section_image' => 'string',
        'rooms_page_section_image_description' => 'string',
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
     * Get the property that owns the rooms page.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the rooms for the rooms page.
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class, 'property_id');
    }
}
