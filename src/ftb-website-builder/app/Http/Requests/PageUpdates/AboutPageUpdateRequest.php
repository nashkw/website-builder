<?php

namespace App\Http\Requests\PageUpdates;

use Illuminate\Foundation\Http\FormRequest;

class AboutPageUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'about_page_section_header' => ['required', 'string', 'max:255'],
            'about_page_section_paragraph' => ['required', 'string', 'max:65535'],
            'about_page_section_image' => ['nullable', 'image'],
            'remove_about_page_section_image' => ['required', 'boolean'],
            'secondary_about_sections' => ['nullable', 'array'],
            'secondary_about_sections.*.secondary_about_section_header' => ['nullable', 'string', 'max:255'],
            'secondary_about_sections.*.secondary_about_section_paragraph' => ['required', 'string', 'max:65535'],
            'secondary_about_sections.*.secondary_about_section_image' => ['nullable'],
            'secondary_about_sections.*.remove_secondary_about_section_image' => ['sometimes', 'boolean'],
            'secondary_about_sections_to_remove' => ['nullable', 'array'],
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
            'secondary_about_sections.*.secondary_about_section_header.string' => 'The section header must be stored as a string.',
            'secondary_about_sections.*.secondary_about_section_header.max' => 'The section header must not be longer than 255 characters.',
            'secondary_about_sections.*.secondary_about_section_paragraph.required' => 'The section text field is required.',
            'secondary_about_sections.*.secondary_about_section_paragraph.string' => 'The section text must be stored as a string.',
            'secondary_about_sections.*.secondary_about_section_paragraph.max' => 'The section text must not be longer than 65535 characters.',
            'secondary_about_sections.*.remove_secondary_about_section_image.boolean' => 'The remove section image toggle must be stored as a boolean.',
        ];
    }
}
