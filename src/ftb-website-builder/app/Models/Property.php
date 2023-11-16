<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /**
     * Get the user that owns the property.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the website associated with the property.
     */
    public function website(): HasOne
    {
        return $this->hasOne(Website::class);
    }

    /**
     * Get the home page associated with the property.
     */
    public function homePage(): HasOne
    {
        return $this->hasOne(HomePage::class);
    }

    /**
     * Get the rooms page associated with the property.
     */
    public function roomsPage(): HasOne
    {
        return $this->hasOne(RoomsPage::class);
    }

    /**
     * Get the reviews page associated with the property.
     */
    public function reviewsPage(): HasOne
    {
        return $this->hasOne(ReviewsPage::class);
    }

    /**
     * Get the home about associated with the property.
     */
    public function aboutPage(): HasOne
    {
        return $this->hasOne(AboutPage::class);
    }

    /**
     * Get the explore page associated with the property.
     */
    public function explorePage(): HasOne
    {
        return $this->hasOne(ExplorePage::class);
    }

    /**
     * Get the find us page associated with the property.
     */
    public function findUsPage(): HasOne
    {
        return $this->hasOne(FindUsPage::class);
    }

    /**
     * Get the FAQ page associated with the property.
     */
    public function faqPage(): HasOne
    {
        return $this->hasOne(FAQPage::class);
    }
}
