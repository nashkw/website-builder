<?php

namespace App\Models\FAQPage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionAndAnswer extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'property_id' => 'integer',
        'review_quote' => 'string',
        'reviewer_name' => 'string',
        'star_rating' => 'integer',
        'review_date' => 'datetime:F Y',
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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'questions_and_answers';

    /**
     * Get the FAQ page that owns the Q&A.
     */
    public function faqPage(): BelongsTo
    {
        return $this->belongsTo(FAQPage::class, 'property_id', 'property_id');
    }
}
