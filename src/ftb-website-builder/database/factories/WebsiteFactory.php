<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Website>
 */
class WebsiteFactory extends Factory
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
            'primary_colour' => str_replace(fake()->hexColor(), '#', ''),
            'secondary_colour' => str_replace(fake()->hexColor(), '#', ''),
            'background_colour' => str_replace(fake()->hexColor(), '#', ''),
            'text_colour' => str_replace(fake()->hexColor(), '#', ''),
            'divider_art' => fake()->mimeType() . '.' . fake()->fileExtension(),
            'font_family' => "Roboto Slab",
            'subdomain' => fake()->unique()->domainWord(),
            'preview_only' => fake()->boolean(),
        ];
    }
}
