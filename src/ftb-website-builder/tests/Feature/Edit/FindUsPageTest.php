<?php

namespace Tests\Feature\Edit;

use App\Models\FindUsPage\FindUsPage;
use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FindUsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_find_us_page_edit_subpage_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(FindUsPage::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/edit/find-us-page');

        $response->assertOk();
    }

    public function test_find_us_page_can_be_updated(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(FindUsPage::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->post('/edit/find-us-page', [
                'find_us_page_section_header' => 'Test header',
                'find_us_page_section_paragraph' => fake()->paragraph(),
                'find_us_page_section_image' => null,
                'remove_find_us_page_section_image' => fake()->boolean(),
                'directions' => [],
                'directions_to_remove' => [],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/edit/find-us-page');

        $user->refresh();

        $this->assertSame('Test header', $user->property->findUsPage->find_us_page_section_header);
    }

    public function test_find_us_page_cannot_be_updated_with_invalid_values(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(FindUsPage::factory()))
            ->create();
        $originalUpdateDate = $user->property->findUsPage->updated_at->toString();

        $response = $this
            ->actingAs($user)
            ->post('/edit/find-us-page', [
                'find_us_page_section_header' => null,
                'find_us_page_section_paragraph' => fake()->words(),
                'find_us_page_section_image' => fake()->words(),
                'remove_find_us_page_section_image' => null,
                'directions' => fake()->sentence(),
                'directions_to_remove' => fake()->sentence(),
            ]);

        $response
            ->assertSessionHasErrors([
                'find_us_page_section_header',
                'find_us_page_section_paragraph',
                'find_us_page_section_image',
                'remove_find_us_page_section_image',
                'directions',
                'directions_to_remove',
            ])
            ->assertRedirect('/');

        $user->refresh();

        $this->assertSame($originalUpdateDate, $user->property->findUsPage->updated_at->toString());
    }
}
