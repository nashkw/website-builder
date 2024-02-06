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

class HostedGeneratedSiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_hosted_home_page_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => false]))
                ->has(HomePage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get(route('website', $user->property->website->subdomain));

        $response->assertOk();
    }

    public function test_hosted_home_page_cannot_be_rendered_when_not_hosted(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => true]))
                ->has(HomePage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get(route('website', $user->property->website->subdomain))
            ->assertRedirect(route('preview'));

        $response->assertFound();
    }

    public function test_hosted_rooms_page_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => false]))
                ->has(RoomsPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get(route('website.rooms', $user->property->website->subdomain));

        $response->assertOk();
    }

    public function test_hosted_rooms_page_cannot_be_rendered_when_not_hosted(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => true]))
                ->has(RoomsPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get(route('website.rooms', $user->property->website->subdomain))
            ->assertRedirect(route('preview.rooms'));

        $response->assertFound();
    }

    public function test_hosted_reviews_page_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => false]))
                ->has(ReviewsPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get(route('website.reviews', $user->property->website->subdomain));

        $response->assertOk();
    }

    public function test_hosted_reviews_page_cannot_be_rendered_when_not_hosted(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => true]))
                ->has(ReviewsPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get(route('website.reviews', $user->property->website->subdomain))
            ->assertRedirect(route('preview.reviews'));

        $response->assertFound();
    }

    public function test_hosted_about_page_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => false]))
                ->has(AboutPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get(route('website.about', $user->property->website->subdomain));

        $response->assertOk();
    }

    public function test_hosted_about_page_cannot_be_rendered_when_not_hosted(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => true]))
                ->has(AboutPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get(route('website.about', $user->property->website->subdomain))
            ->assertRedirect(route('preview.about'));

        $response->assertFound();
    }

    public function test_hosted_explore_page_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => false]))
                ->has(ExplorePage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get(route('website.explore', $user->property->website->subdomain));

        $response->assertOk();
    }

    public function test_hosted_explore_page_cannot_be_rendered_when_not_hosted(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => true]))
                ->has(ExplorePage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get(route('website.explore', $user->property->website->subdomain))
            ->assertRedirect(route('preview.explore'));

        $response->assertFound();
    }

    public function test_hosted_find_us_page_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => false]))
                ->has(FindUsPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get(route('website.findus', $user->property->website->subdomain));

        $response->assertOk();
    }

    public function test_hosted_find_us_page_cannot_be_rendered_when_not_hosted(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => true]))
                ->has(FindUsPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get(route('website.findus', $user->property->website->subdomain))
            ->assertRedirect(route('preview.findus'));

        $response->assertFound();
    }

    public function test_hosted_faq_page_can_be_rendered(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => false]))
                ->has(FAQPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get(route('website.faq', $user->property->website->subdomain));

        $response->assertOk();
    }

    public function test_hosted_faq_page_cannot_be_rendered_when_not_hosted(): void
    {
        $user = User::factory()
            ->has(Property::factory()
                ->has(Website::factory()->state(['preview_only' => true]))
                ->has(FAQPage::factory())
            )
            ->create();

        $response = $this
            ->actingAs($user)
            ->get(route('website.faq', $user->property->website->subdomain))
            ->assertRedirect(route('preview.faq'));

        $response->assertFound();
    }
}
