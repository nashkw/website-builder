<?php

namespace App\Http\Requests\PageUpdates;

use Illuminate\Foundation\Http\FormRequest;

class ReviewsPageUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reviews_page_section_header' => ['required', 'string', 'max:255'],
            'reviews_page_section_paragraph' => ['nullable', 'string', 'max:65535'],
            'reviews_page_section_image' => ['nullable', 'image'],
            'remove_reviews_page_section_image' => ['required', 'boolean'],
            'reviews' => ['nullable', 'array'],
            'reviews.*.review_quote' => ['required', 'string', 'max:1000'],
            'reviews.*.reviewer_name' => ['required', 'string', 'max:255'],
            'reviews.*.star_rating' => ['nullable', 'numeric', 'min:0', 'max:10'],
            'reviews.*.review_date' => ['nullable', 'date'],
            'reviews_to_remove' => ['nullable', 'array'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'reviews.*.review_quote.required' => 'The review text field is required.',
            'reviews.*.review_quote.string' => 'The review text must be stored as a string.',
            'reviews.*.review_quote.max' => 'The review text must not be longer than 1000 characters.',
            'reviews.*.reviewer_name.required' => 'The reviewer name field is required.',
            'reviews.*.reviewer_name.string' => 'The reviewer must be stored as a string.',
            'reviews.*.reviewer_name.max' => 'The reviewer name must not be longer than 255 characters.',
            'reviews.*.star_rating.min' => 'The star rating must be between 0 and 5 stars.',
            'reviews.*.star_rating.max' => 'The star rating must be between 0 and 5 stars.',
            'reviews.*.star_rating.numeric' => 'The star rating field must be stored as a number.',
            'reviews.*.review_date.date' => 'The star rating must be stored as a date.',
        ];
    }
}
