<?php

namespace App\Http\Requests\PageCreation;

use Illuminate\Foundation\Http\FormRequest;

class FAQPageCreationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'faq_page_section_header' => ['required', 'string', 'max:255'],
            'faq_page_section_paragraph' => ['nullable', 'string', 'max:65535'],
            'faq_page_section_image' => ['nullable', 'image'],
            'remove_faq_page_section_image' => ['required', 'boolean'],
            'questions_and_answers' => ['required', 'array'],
            'questions_and_answers.*.question_label' => ['required', 'string', 'max:255'],
            'questions_and_answers.*.answer_paragraph' => ['required', 'string', 'max:2000'],
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
            'questions_and_answers.required' => 'You must include Q&As on your FAQ page.',
            'questions_and_answers.array' => 'Your Q&As must be packaged in an array.',
            'questions_and_answers.*.question_label.required' => 'The question label field is required.',
            'questions_and_answers.*.question_label.string' => 'The question label field must be stored as a string.',
            'questions_and_answers.*.question_label.max' => 'The question label must not be longer than 255 characters.',
            'questions_and_answers.*.answer_paragraph.required' => 'The answer paragraph field is required.',
            'questions_and_answers.*.answer_paragraph.string' => 'The answer paragraph field must be stored as a string.',
            'questions_and_answers.*.answer_paragraph.max' => 'The answer paragraph must not be longer than 2000 characters.',
        ];
    }
}
