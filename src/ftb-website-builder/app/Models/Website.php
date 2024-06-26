<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
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
        'primary_colour' => 'string',
        'secondary_colour' => 'string',
        'background_colour' => 'string',
        'text_colour' => 'string',
        'divider_art' => 'string',
        'font_family' => 'string',
        'subdomain' => 'string',
        'preview_only' => 'boolean',
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
     * Get the property that owns the website.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
