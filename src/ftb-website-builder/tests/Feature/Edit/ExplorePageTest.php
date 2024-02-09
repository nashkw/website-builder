<?php

namespace Tests\Feature\Edit;

use App\Models\ExplorePage\ExplorePage;
use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExplorePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_explore_page_edit_subpage_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(ExplorePage::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/edit/explore-page');

        $response->assertOk();
    }

    public function test_explore_page_can_be_updated(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(ExplorePage::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->post('/edit/explore-page', [
                'explore_page_section_header' => 'Test header',
                'explore_page_section_paragraph' => fake()->paragraph(),
                'explore_page_section_image' => null,
                'remove_explore_page_section_image' => fake()->boolean(),
                'attractions' => [],
                'attractions_to_remove' => [],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/edit/explore-page');

        $user->refresh();

        $this->assertSame('Test header', $user->property->explorePage->explore_page_section_header);
    }

    public function test_explore_page_cannot_be_updated_with_invalid_values(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(ExplorePage::factory()))
            ->create();
        $originalUpdateDate = $user->property->explorePage->updated_at->toString();

        $response = $this
            ->actingAs($user)
            ->post('/edit/explore-page', [
                'explore_page_section_header' => null,
                'explore_page_section_paragraph' => fake()->words(),
                'explore_page_section_image' => fake()->words(),
                'remove_explore_page_section_image' => null,
                'attractions' => fake()->sentence(),
                'attractions_to_remove' => fake()->sentence(),
            ]);

        $response
            ->assertSessionHasErrors([
                'explore_page_section_header',
                'explore_page_section_paragraph',
                'explore_page_section_image',
                'remove_explore_page_section_image',
                'attractions',
                'attractions_to_remove',
            ])
            ->assertRedirect('/');

        $user->refresh();

        $this->assertSame($originalUpdateDate, $user->property->explorePage->updated_at->toString());
    }
}
