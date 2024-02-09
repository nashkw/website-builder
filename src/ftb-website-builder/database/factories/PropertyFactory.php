<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'property_name' => fake()->company(),
            'property_address_line_1' => fake()->streetAddress(),
            'property_address_line_2' => null,
            'property_address_area' => fake()->city(),
            'property_address_country' => fake()->country(),
            'property_address_postcode' => fake()->postcode(),
            'property_telephone' => fake()->phoneNumber(),
            'property_email' => fake()->email(),
            'property_twitter_link' => fake()->url(),
            'property_youtube_link' => fake()->url(),
            'property_linkedin_link' => fake()->url(),
            'property_facebook_link' => fake()->url(),
            'property_instagram_link' => fake()->url(),
            'property_tripadvisor_link' => fake()->url(),
            'property_logo' => fake()->mimeType() . '.' . fake()->fileExtension(),
            'property_favicon' => fake()->mimeType() . '.ico',
            'property_booking_link' => fake()->url(),
        ];
    }
}
