<?php

namespace App\Http\Requests\PageUpdates;

use Illuminate\Foundation\Http\FormRequest;

class ExplorePageUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'explore_page_section_header' => ['required', 'string', 'max:255'],
            'explore_page_section_paragraph' => ['nullable', 'string', 'max:65535'],
            'explore_page_section_image' => ['nullable', 'image'],
            'remove_explore_page_section_image' => ['required', 'boolean'],
            'attractions' => ['nullable', 'array'],
            'attractions.*.attraction_header' => ['nullable', 'string', 'max:255'],
            'attractions.*.attraction_paragraph' => ['required', 'string', 'max:65535'],
            'attractions.*.attraction_image' => ['nullable'],
            'attractions.*.remove_attraction_image' => ['sometimes', 'boolean'],
            'attractions_to_remove' => ['nullable', 'array'],
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
            'attractions.*.attraction_header.string' => 'The attraction header must be stored as a string.',
            'attractions.*.attraction_header.max' => 'The attraction header must not be longer than 255 characters.',
            'attractions.*.attraction_paragraph.required' => 'The attraction description field is required.',
            'attractions.*.attraction_paragraph.string' => 'The attraction description must be stored as a string.',
            'attractions.*.attraction_paragraph.max' => 'The attraction description must not be longer than 65535 characters.',
            'attractions.*.remove_attraction_image.boolean' => 'The remove attraction image toggle must be stored as a boolean.',
        ];
    }
}
