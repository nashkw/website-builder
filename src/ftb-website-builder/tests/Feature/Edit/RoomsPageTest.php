<?php

namespace Tests\Feature\Edit;

use App\Models\Property;
use App\Models\RoomsPage\RoomsPage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_rooms_page_edit_subpage_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(RoomsPage::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/edit/rooms-page');

        $response->assertOk();
    }

    public function test_rooms_page_can_be_updated(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(RoomsPage::factory()))
            ->create();

        $response = $this
            ->actingAs($user)
            ->post('/edit/rooms-page', [
                'rooms_page_section_header' => 'Test header',
                'rooms_page_section_paragraph' => fake()->paragraph(),
                'rooms_page_section_image' => null,
                'remove_rooms_page_section_image' => fake()->boolean(),
                'rooms' => [],
                'rooms_to_remove' => [],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/edit/rooms-page');

        $user->refresh();

        $this->assertSame('Test header', $user->property->roomsPage->rooms_page_section_header);
    }

    public function test_rooms_page_cannot_be_updated_with_invalid_values(): void
    {
        $user = User::factory()
            ->has(Property::factory()->has(RoomsPage::factory()))
            ->create();
        $originalUpdateDate = $user->property->roomsPage->updated_at->toString();

        $response = $this
            ->actingAs($user)
            ->post('/edit/rooms-page', [
                'rooms_page_section_header' => null,
                'rooms_page_section_paragraph' => fake()->words(),
                'rooms_page_section_image' => fake()->words(),
                'remove_rooms_page_section_image' => null,
                'rooms' => fake()->sentence(),
                'rooms_to_remove' => fake()->sentence(),
            ]);

        $response
            ->assertSessionHasErrors([
                'rooms_page_section_header',
                'rooms_page_section_paragraph',
                'rooms_page_section_image',
                'remove_rooms_page_section_image',
                'rooms',
                'rooms_to_remove',
            ])
            ->assertRedirect('/');

        $user->refresh();

        $this->assertSame($originalUpdateDate, $user->property->roomsPage->updated_at->toString());
    }
}
