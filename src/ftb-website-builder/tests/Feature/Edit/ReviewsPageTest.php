<?php

namespace Tests\Feature\Edit;

use App\Models\Property;
use App\Models\ReviewsPage\ReviewsPage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_reviews_page_edit_subpage_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(ReviewsPage::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/edit/reviews-page');

        $response->assertOk();
    }

    public function test_reviews_page_can_be_updated(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(ReviewsPage::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->post('/edit/reviews-page', [
                'reviews_page_section_header' => 'Test header',
                'reviews_page_section_paragraph' => fake()->paragraph(),
                'reviews_page_section_image' => null,
                'remove_reviews_page_section_image' => fake()->boolean(),
                'reviews' => [],
                'reviews_to_remove' => [],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/edit/reviews-page');

        $user->refresh();

        $this->assertSame('Test header', $user->property->reviewsPage->reviews_page_section_header);
    }

    public function test_reviews_page_cannot_be_updated_with_invalid_values(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(ReviewsPage::factory()))
            ->create();
        $originalUpdateDate = $user->property->reviewsPage->updated_at->toString();

        $response = $this
            ->actingAs($user)
            ->post('/edit/reviews-page', [
                'reviews_page_section_header' => null,
                'reviews_page_section_paragraph' => fake()->words(),
                'reviews_page_section_image' => fake()->words(),
                'remove_reviews_page_section_image' => null,
                'reviews' => fake()->sentence(),
                'reviews_to_remove' => fake()->sentence(),
            ]);

        $response
            ->assertSessionHasErrors([
                'reviews_page_section_header',
                'reviews_page_section_paragraph',
                'reviews_page_section_image',
                'remove_reviews_page_section_image',
                'reviews',
                'reviews_to_remove',
            ])
            ->assertRedirect('/');

        $user->refresh();

        $this->assertSame($originalUpdateDate, $user->property->reviewsPage->updated_at->toString());
    }
}
