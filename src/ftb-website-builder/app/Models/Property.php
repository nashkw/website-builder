<?php

namespace App\Models;

use App\Models\AboutPage\AboutPage;
use App\Models\ExplorePage\ExplorePage;
use App\Models\FAQPage\FAQPage;
use App\Models\FindUsPage\FindUsPage;
use App\Models\HomePage\HomePage;
use App\Models\ReviewsPage\ReviewsPage;
use App\Models\RoomsPage\RoomsPage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Property extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'property_name' => 'string',
        'property_address_line_1' => 'string',
        'property_address_line_2' => 'string',
        'property_address_area' => 'string',
        'property_address_country' => 'string',
        'property_address_postcode' => 'string',
        'property_telephone' => 'string',
        'property_email' => 'string',
        'property_twitter_link' => 'string',
        'property_youtube_link' => 'string',
        'property_linkedin_link' => 'string',
        'property_facebook_link' => 'string',
        'property_instagram_link' => 'string',
        'property_tripadvisor_link' => 'string',
        'property_logo' => 'string',
        'property_booking_link' => 'string',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'user_id',
    ];

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
