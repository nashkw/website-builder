<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyDetailsTest extends TestCase
{
    use RefreshDatabase;

    public function test_property_details_edit_subpage_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory())
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/edit/property');

        $response->assertOk();
    }

    public function test_property_details_can_be_updated(): void
    {
        $user = User::factory()
            ->has(Property::factory())
            ->create();

        $response = $this
            ->actingAs($user)
            ->post('/edit/property', [
                'property_name' => 'Test Property',
                'property_address_line_1' => fake()->buildingNumber(),
                'property_address_line_2' => fake()->streetName(),
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
                'property_logo' => null,
                'remove_property_logo' => false,
                'property_booking_link' => fake()->url(),
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/edit/property');

        $user->refresh();

        $this->assertSame('Test Property', $user->property->property_name);
    }

    public function test_property_details_cannot_be_updated_with_invalid_values(): void
    {
        $user = User::factory()
            ->has(Property::factory())
            ->create();
        $originalUpdateDate = $user->property->updated_at->toString();

        $response = $this
            ->actingAs($user)
            ->post('/edit/property', [
                'property_name' => fake()->words(),
                'property_address_line_1' => null,
                'property_address_line_2' => fake()->words(),
                'property_address_area' => null,
                'property_address_country' => fake()->words(),
                'property_address_postcode' => null,
                'property_telephone' => fake()->words(),
                'property_email' => null,
                'property_twitter_link' => fake()->words(),
                'property_youtube_link' => fake()->words(),
                'property_linkedin_link' => fake()->words(),
                'property_facebook_link' => fake()->words(),
                'property_instagram_link' => fake()->words(),
                'property_tripadvisor_link' => fake()->words(),
                'property_logo' => fake()->words(),
                'remove_property_logo' => fake()->paragraph(),
                'property_booking_link' => null,
            ]);

        $response
            ->assertSessionHasErrors([
                'property_name',
                'property_address_line_1',
                'property_address_line_2',
                'property_address_area',
                'property_address_country',
                'property_address_postcode',
                'property_telephone',
                'property_email',
                'property_twitter_link',
                'property_youtube_link',
                'property_linkedin_link',
                'property_facebook_link',
                'property_instagram_link',
                'property_tripadvisor_link',
                'property_logo',
                'remove_property_logo',
                'property_booking_link',
            ])
            ->assertRedirect('/');

        $user->refresh();

        $this->assertSame($originalUpdateDate, $user->property->updated_at->toString());
    }
}
