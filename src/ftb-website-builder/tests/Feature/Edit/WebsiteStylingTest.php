<?php

namespace Tests\Feature\Edit;

use App\Models\Property;
use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteStylingTest extends TestCase
{
    use RefreshDatabase;

    public function test_website_styling_edit_subpage_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(Website::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/edit/website');

        $response->assertOk();
    }

    public function test_website_styling_can_be_updated(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(Website::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->post('/edit/website', [
                'primary_colour' => '47ce01',
                'secondary_colour' => 'e86a02',
                'background_colour' => '210855',
                'text_colour' => 'e0c392',
                'divider_art' => null,
                'remove_divider_art' => false,
                'font_family' => "Noto Sans",
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/edit/website');

        $user->refresh();

        $this->assertSame('47ce01', $user->property->website->primary_colour);
    }

    public function test_website_styling_cannot_be_updated_with_invalid_values(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(Website::factory()))
            ->create();
        $originalUpdateDate = $user->property->website->updated_at->toString();

        $response = $this
            ->actingAs($user)
            ->post('/edit/website', [
                'primary_colour' => fake()->paragraph(),
                'secondary_colour' => fake()->paragraph(),
                'background_colour' => fake()->paragraph(),
                'text_colour' => fake()->paragraph(),
                'divider_art' => fake()->words(),
                'remove_divider_art' => null,
                'font_family' => fake()->words(),
            ]);

        $response
            ->assertSessionHasErrors([
                'primary_colour',
                'secondary_colour',
                'background_colour',
                'text_colour',
                'divider_art',
                'remove_divider_art',
                'font_family',
            ])
            ->assertRedirect('/');

        $user->refresh();

        $this->assertSame($originalUpdateDate, $user->property->website->updated_at->toString());
    }
}
