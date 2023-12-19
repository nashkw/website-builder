<?php

namespace App\Models\RoomsPage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SecondaryRoomImage extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'room_id' => 'integer',
        'room_name' => 'string',
        'secondary_room_image' => 'string',
        'secondary_room_image_description' => 'string',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'room_id',
    ];

    /**
     * Get the room that owns the secondary room image.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }
}
