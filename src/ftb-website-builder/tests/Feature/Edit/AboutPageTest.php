<?php

namespace Tests\Feature\Edit;

use App\Models\AboutPage\AboutPage;
use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_about_page_edit_subpage_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(AboutPage::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/edit/about-page');

        $response->assertOk();
    }

    public function test_about_page_can_be_updated(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(AboutPage::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->post('/edit/about-page', [
                'about_page_section_header' => 'Test header',
                'about_page_section_paragraph' => fake()->paragraph(),
                'about_page_section_image' => null,
                'remove_about_page_section_image' => fake()->boolean(),
                'secondary_about_sections' => [],
                'secondary_about_sections_to_remove' => [],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/edit/about-page');

        $user->refresh();

        $this->assertSame('Test header', $user->property->aboutPage->about_page_section_header);
    }

    public function test_about_page_cannot_be_updated_with_invalid_values(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(AboutPage::factory()))
            ->create();
        $originalUpdateDate = $user->property->aboutPage->updated_at->toString();

        $response = $this
            ->actingAs($user)
            ->post('/edit/about-page', [
                'about_page_section_header' => null,
                'about_page_section_paragraph' => fake()->words(),
                'about_page_section_image' => fake()->words(),
                'remove_about_page_section_image' => null,
                'secondary_about_sections' => fake()->sentence(),
                'secondary_about_sections_to_remove' => fake()->sentence(),
            ]);

        $response
            ->assertSessionHasErrors([
                'about_page_section_header',
                'about_page_section_paragraph',
                'about_page_section_image',
                'remove_about_page_section_image',
                'secondary_about_sections',
                'secondary_about_sections_to_remove',
            ])
            ->assertRedirect('/');

        $user->refresh();

        $this->assertSame($originalUpdateDate, $user->property->aboutPage->updated_at->toString());
    }
}
