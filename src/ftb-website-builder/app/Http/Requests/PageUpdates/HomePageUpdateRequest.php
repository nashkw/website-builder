<?php

namespace App\Http\Requests\PageUpdates;

use Illuminate\Foundation\Http\FormRequest;

class HomePageUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cover_image_primary' => ['nullable', 'image'],
            'intro_section_header' => ['required', 'string', 'max:255'],
            'intro_section_paragraph' => ['required', 'string', 'max:65535'],
            'intro_section_image' => ['nullable', 'image'],
            'remove_intro_section_image' => ['required', 'boolean'],
            'welcome_section_header' => ['required', 'string', 'max:255'],
            'welcome_section_paragraph' => ['required', 'string', 'max:65535'],
            'welcome_section_image' => ['nullable', 'image'],
            'remove_welcome_section_image' => ['required', 'boolean'],
            'secondary_cover_images' => ['nullable', 'array'],
            'secondary_cover_images.*.secondary_cover_image' => ['required'],
            'secondary_cover_images_to_remove' => ['nullable', 'array'],
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
            'secondary_cover_images.*.secondary_cover_image.required' => 'The secondary cover image field is required.',
        ];
    }
}
