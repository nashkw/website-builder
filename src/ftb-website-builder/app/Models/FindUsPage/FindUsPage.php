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
        return $this->hasMany(Direction::class);
    }
}
