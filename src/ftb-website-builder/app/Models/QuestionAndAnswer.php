<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

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
