<?php

namespace App\Models\FAQPage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionAndAnswer extends Model
{
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
        return $this->belongsTo(FAQPage::class);
    }
}
