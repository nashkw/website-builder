<?php

namespace App\Models\RoomsPage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    /**
     * Get the rooms page that owns the room.
     */
    public function roomsPage(): BelongsTo
    {
        return $this->belongsTo(RoomsPage::class);
    }

    /**
     * Get the secondary room images for the room.
     */
    public function secondaryRoomImages(): HasMany
    {
        return $this->hasMany(SecondaryRoomImage::class);
    }
}
