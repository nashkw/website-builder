<?php

namespace Tests\Feature\GeneratedSite;

use App\Models\AboutPage\AboutPage;
use App\Models\ExplorePage\ExplorePage;
use App\Models\FAQPage\FAQPage;
use App\Models\FindUsPage\FindUsPage;
use App\Models\HomePage\HomePage;
use App\Models\Property;
use App\Models\ReviewsPage\ReviewsPage;
use App\Models\RoomsPage\RoomsPage;
use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PreviewGeneratedSiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_preview_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => true]))
                ->has(HomePage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/preview/');

        $response->assertOk();
    }

    public function test_home_page_preview_cannot_be_rendered_when_hosted(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => false]))
                ->has(HomePage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/preview/')
            ->assertRedirect(route('website', $user->property->website->subdomain));

        $response->assertFound();
    }

    public function test_rooms_page_preview_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => true]))
                ->has(RoomsPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/preview/rooms');

        $response->assertOk();
    }

    public function test_rooms_page_preview_cannot_be_rendered_when_hosted(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => false]))
                ->has(RoomsPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/preview/rooms')
            ->assertRedirect(route('website.rooms', $user->property->website->subdomain));

        $response->assertFound();
    }

    public function test_reviews_page_preview_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => true]))
                ->has(ReviewsPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/preview/reviews');

        $response->assertOk();
    }

    public function test_reviews_page_preview_cannot_be_rendered_when_hosted(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => false]))
                ->has(ReviewsPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/preview/reviews')
            ->assertRedirect(route('website.reviews', $user->property->website->subdomain));

        $response->assertFound();
    }

    public function test_about_page_preview_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => true]))
                ->has(AboutPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/preview/about');

        $response->assertOk();
    }

    public function test_about_page_preview_cannot_be_rendered_when_hosted(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => false]))
                ->has(AboutPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/preview/about')
            ->assertRedirect(route('website.about', $user->property->website->subdomain));

        $response->assertFound();
    }

    public function test_explore_page_preview_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => true]))
                ->has(ExplorePage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/preview/explore');

        $response->assertOk();
    }

    public function test_explore_page_preview_cannot_be_rendered_when_hosted(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => false]))
                ->has(ExplorePage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/preview/explore')
            ->assertRedirect(route('website.explore', $user->property->website->subdomain));

        $response->assertFound();
    }

    public function test_find_us_page_preview_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => true]))
                ->has(FindUsPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/preview/find-us');

        $response->assertOk();
    }

    public function test_find_us_page_preview_cannot_be_rendered_when_hosted(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => false]))
                ->has(FindUsPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/preview/find-us')
            ->assertRedirect(route('website.findus', $user->property->website->subdomain));

        $response->assertFound();
    }

    public function test_faq_page_preview_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => true]))
                ->has(FAQPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/preview/faq');

        $response->assertOk();
    }

    public function test_faq_page_preview_cannot_be_rendered_when_hosted(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => false]))
                ->has(FAQPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get('/preview/faq')
            ->assertRedirect(route('website.faq', $user->property->website->subdomain));

        $response->assertFound();
    }
}
