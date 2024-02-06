<?php

namespace Database\Factories\HomePage;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HomePage\HomePage>
 */
class HomePageFactory extends Factory
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
            'meta_page_description' => fake()->paragraph(),
            'cover_image_primary' => fake()->mimeType() . '.' . fake()->fileExtension(),
            'cover_image_primary_description' => fake()->sentence(),
            'intro_section_header' => fake()->sentence(),
            'intro_section_paragraph' => fake()->paragraph(),
            'intro_section_image' => fake()->mimeType() . '.' . fake()->fileExtension(),
            'intro_section_image_description' => fake()->sentence(),
            'welcome_section_header' => fake()->sentence(),
            'welcome_section_paragraph' => fake()->paragraph(),
            'welcome_section_image' => fake()->mimeType() . '.' . fake()->fileExtension(),
            'welcome_section_image_description' => fake()->sentence(),
        ];
    }
}
