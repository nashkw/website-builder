<?php

namespace App\Http\Requests\PageUpdates;

use Illuminate\Foundation\Http\FormRequest;

class RoomsPageUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rooms_page_section_header' => ['required', 'string', 'max:255'],
            'rooms_page_section_paragraph' => ['nullable', 'string', 'max:65535'],
            'rooms_page_section_image' => ['nullable', 'image'],
            'remove_rooms_page_section_image' => ['required', 'boolean'],
            'rooms' => ['nullable', 'array'],
            'rooms.*.room_name' => ['required', 'string', 'max:255'],
            'rooms.*.room_description' => ['required', 'string', 'max:65535'],
            'rooms.*.room_image_primary' => ['required'],
            'rooms.*.secondary_room_images' => ['nullable', 'array'],
            'rooms.*.secondary_room_images.secondary_room_image' => ['required'],
            'rooms.*.secondary_room_images_to_remove' => ['nullable', 'array'],
            'rooms_to_remove' => ['nullable', 'array'],
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
            'rooms.*.room_name.required' => 'The room name field is required.',
            'rooms.*.room_name.string' => 'The room name must be stored as a string.',
            'rooms.*.room_name.max' => 'The room name must not be longer than 255 characters.',
            'rooms.*.room_description.required' => 'The room description field is required.',
            'rooms.*.room_description.string' => 'The room description must be stored as a string.',
            'rooms.*.room_description.max' => 'The room description must not be longer than 65535 characters.',
            'rooms.*.room_image_primary.required' => 'The primary room image field is required.',
            'rooms.*.secondary_room_images.secondary_room_image' => 'The secondary room image field is required',
        ];
    }
}
