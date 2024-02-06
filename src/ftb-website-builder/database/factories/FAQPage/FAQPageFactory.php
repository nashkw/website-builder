<?php

namespace Database\Factories\FAQPage;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FAQPage\FAQPage>
 */
class FAQPageFactory extends Factory
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
            'faq_page_section_header' => fake()->sentence(),
            'faq_page_section_paragraph' => fake()->paragraph(),
            'faq_page_section_image' => fake()->mimeType() . '.' . fake()->fileExtension(),
            'faq_page_section_image_description' => fake()->sentence(),
        ];
    }
}
