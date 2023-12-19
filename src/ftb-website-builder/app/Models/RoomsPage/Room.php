<?php

namespace App\Models\RoomsPage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'property_id' => 'integer',
        'room_name' => 'string',
        'room_description' => 'string',
        'room_image_primary' => 'string',
        'room_image_primary_description' => 'string',
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
     * Get the rooms page that owns the room.
     */
    public function roomsPage(): BelongsTo
    {
        return $this->belongsTo(RoomsPage::class, 'property_id', 'property_id');
    }

    /**
     * Get the secondary room images for the room.
     */
    public function secondaryRoomImages(): HasMany
    {
        return $this->hasMany(SecondaryRoomImage::class, 'room_id');
    }
}
