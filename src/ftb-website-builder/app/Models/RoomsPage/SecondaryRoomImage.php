<?php

namespace App\Models\RoomsPage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SecondaryRoomImage extends Model
{
    /**
     * Get the room that owns the secondary room image.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
