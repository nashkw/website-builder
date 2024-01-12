<?php

namespace App\Http\Requests\PageUpdates;

use Illuminate\Foundation\Http\FormRequest;

class FindUsPageUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'find_us_page_section_header' => ['required', 'string', 'max:255'],
            'find_us_page_section_paragraph' => ['required', 'string', 'max:65535'],
            'find_us_page_section_image' => ['nullable', 'image'],
            'remove_find_us_page_section_image' => ['required', 'boolean'],
            'directions' => ['nullable', 'array'],
            'directions.*.directions_label' => ['required', 'string', 'max:255'],
            'directions.*.directions_paragraph' => ['required', 'string', 'max:2000'],
            'directions_to_remove' => ['nullable', 'array'],
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
            'directions.*.directions_label.required' => 'The directions label field is required.',
            'directions.*.directions_label.string' => 'The directions label field must be stored as a string.',
            'directions.*.directions_label.max' => 'The directions label must not be longer than 255 characters.',
            'directions.*.directions_paragraph.required' => 'The directions paragraph field is required.',
            'directions.*.directions_paragraph.string' => 'The directions paragraph field must be stored as a string.',
            'directions.*.directions_paragraph.max' => 'The directions paragraph must not be longer than 2000 characters.',
        ];
    }
}
