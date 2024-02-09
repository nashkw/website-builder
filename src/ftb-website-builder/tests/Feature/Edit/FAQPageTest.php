<?php

namespace Tests\Feature\Edit;

use App\Models\FAQPage\FAQPage;
use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FAQPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_faq_page_edit_subpage_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(FAQPage::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/edit/faq-page');

        $response->assertOk();
    }

    public function test_faq_page_can_be_updated(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(FAQPage::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->post('/edit/faq-page', [
                'faq_page_section_header' => 'Test header',
                'faq_page_section_paragraph' => fake()->paragraph(),
                'faq_page_section_image' => null,
                'remove_faq_page_section_image' => fake()->boolean(),
                'questions_and_answers' => [],
                'questions_and_answers_to_remove' => [],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/edit/faq-page');

        $user->refresh();

        $this->assertSame('Test header', $user->property->faqPage->faq_page_section_header);
    }

    public function test_faq_page_cannot_be_updated_with_invalid_values(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(FAQPage::factory()))
            ->create();
        $originalUpdateDate = $user->property->faqPage->updated_at->toString();

        $response = $this
            ->actingAs($user)
            ->post('/edit/faq-page', [
                'faq_page_section_header' => null,
                'faq_page_section_paragraph' => fake()->words(),
                'faq_page_section_image' => fake()->words(),
                'remove_faq_page_section_image' => null,
                'questions_and_answers' => fake()->sentence(),
                'questions_and_answers_to_remove' => fake()->sentence(),
            ]);

        $response
            ->assertSessionHasErrors([
                'faq_page_section_header',
                'faq_page_section_paragraph',
                'faq_page_section_image',
                'remove_faq_page_section_image',
                'questions_and_answers',
                'questions_and_answers_to_remove',
            ])
            ->assertRedirect('/');

        $user->refresh();

        $this->assertSame($originalUpdateDate, $user->property->faqPage->updated_at->toString());
    }
}
