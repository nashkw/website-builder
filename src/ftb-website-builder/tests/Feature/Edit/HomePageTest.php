<?php

namespace Tests\Feature\Edit;

use App\Models\HomePage\HomePage;
use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_edit_subpage_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(HomePage::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/edit/home-page');

        $response->assertOk();
    }

    public function test_home_page_can_be_updated(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(HomePage::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->post('/edit/home-page', [
                'cover_image_primary' => null,
                'intro_section_header' => "Test header",
                'intro_section_paragraph' => fake()->paragraph(),
                'intro_section_image' => null,
                'remove_intro_section_image' => false,
                'welcome_section_header' => fake()->sentence(),
                'welcome_section_paragraph' => fake()->paragraph(),
                'welcome_section_image' => null,
                'remove_welcome_section_image' => false,
                'secondary_cover_images' => [],
                'secondary_cover_images_to_remove' => [],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/edit/home-page');

        $user->refresh();

        $this->assertSame('Test header', $user->property->homePage->intro_section_header);
    }

    public function test_home_page_cannot_be_updated_with_invalid_values(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(HomePage::factory()))
            ->create();
        $originalUpdateDate = $user->property->homePage->updated_at->toString();

        $response = $this
            ->actingAs($user)
            ->post('/edit/home-page', [
                'cover_image_primary' => fake()->words(),
                'intro_section_header' => null,
                'intro_section_paragraph' => null,
                'intro_section_image' => fake()->words(),
                'remove_intro_section_image' => null,
                'welcome_section_header' => null,
                'welcome_section_paragraph' => null,
                'welcome_section_image' => fake()->words(),
                'remove_welcome_section_image' => null,
                'secondary_cover_images' => fake()->sentence(),
                'secondary_cover_images_to_remove' => fake()->sentence(),
            ]);

        $response
            ->assertSessionHasErrors([
                'cover_image_primary',
                'intro_section_header',
                'intro_section_paragraph',
                'intro_section_image',
                'remove_intro_section_image',
                'welcome_section_header',
                'welcome_section_paragraph',
                'welcome_section_image',
                'remove_welcome_section_image',
                'secondary_cover_images',
                'secondary_cover_images_to_remove',
            ])
            ->assertRedirect('/');

        $user->refresh();

        $this->assertSame($originalUpdateDate, $user->property->homePage->updated_at->toString());
    }
}
