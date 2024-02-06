<?php

namespace Database\Factories\RoomsPage;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomsPage\RoomsPage>
 */
class RoomsPageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => Property::factory(),
            'meta_page_title' => fake()->sentence(),
            'meta_page_description' => fake()->sentence(),
            'rooms_page_section_header' => fake()->sentence(),
            'rooms_page_section_paragraph' => fake()->paragraph(),
            'rooms_page_section_image' => fake()->mimeType() . '.' . fake()->fileExtension(),
            'rooms_page_section_image_description' => fake()->sentence(),
        ];
    }
}
