<?php

namespace App\Models\FAQPage;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FAQPage extends Model
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
        'faq_page_section_header' => 'string',
        'faq_page_section_paragraph' => 'string',
        'faq_page_section_image' => 'string',
        'faq_page_section_image_description' => 'string',
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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faq_pages';

    /**
     * Get the property that owns the FAQ page.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the Q&As for the FAQ page.
     */
    public function questionsAndAnswers(): HasMany
    {
        return $this->hasMany(QuestionAndAnswer::class, 'property_id');
    }
}
