<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerServices;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\WebsiteController;
use App\Http\Requests\PageUpdates\ReviewsPageUpdateRequest;
use App\Models\ReviewsPage\Review;
use App\Models\User;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ReviewsPageController extends Controller
{
    /**
     * Display the generated site reviews page.
     */
    public function display(Request $request): Response|RedirectResponse
    {
        $subdomain = $request->route()->parameters()['subdomain'];
        $website = Website::firstWhere('subdomain', $subdomain);
        if (!$website) {
            return Redirect::route('landing');
        } else if ($website->preview_only) {
            return Redirect::route('preview.reviews');
        }

        $user = $website->property->user_id;
        return Inertia::render(
            'GeneratedSite/GenerateReviews',
            [
                'reviews_page' => $this->getReviewsPageData($user),
                'property' => PropertyController::getPropertyData($user),
                'website' => WebsiteController::getWebsiteData($user),
                'routes' => ControllerServices::getRoutes('website', ['subdomain' => $subdomain]),
                'isPreview' => false,
            ]
        );
    }

    /**
     * Display a preview of the generated site reviews page.
     */
    public function preview(Request $request): Response|RedirectResponse
    {
        $website = User::find($request->user()->id)->property->website;
        if (!$website->preview_only) {
            return Redirect::route('website.reviews', ['subdomain' => $website->subdomain]);
        }

        return Inertia::render(
            'GeneratedSite/GenerateReviews',
            [
                'reviews_page' => $this->getReviewsPageData($request->user()->id),
                'property' => PropertyController::getPropertyData($request->user()->id),
                'website' => WebsiteController::getWebsiteData($request->user()->id),
                'routes' => ControllerServices::getRoutes('preview'),
                'isPreview' => true,
            ]
        );
    }

    /**
     * Display the edit subpage for the generated site reviews page.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render(
            'EditContent/EditReviews',
            $this->getReviewsPageData($request->user()->id, true)
        );
    }

    /**
     * Update the user's generated site reviews page information.
     */
    public function update(ReviewsPageUpdateRequest $request): RedirectResponse
    {
        $request->validated();

        $imagePath = 'images/' . User::find($request->user()->id)->property->id . '/';
        $reviewsPage = User::find($request->user()->id)->property->reviewsPage;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'reviews_page_section_image',
            'remove_reviews_page_section_image',
            $imagePath,
            $reviewsPage,
            $data
        );

        foreach ($data['reviews_to_remove'] as $reviewID) {
            Review::find($reviewID)->delete();
        }
        unset($data['reviews_to_remove']);

        foreach ($data['reviews'] as $review) {
            if($review['id']) {
                $existingReview = Review::find($review['id']);
            } else {
                $existingReview = new Review;
                $existingReview->property_id = $reviewsPage->property_id;
            }

            if($review['star_rating']) {
                $review['star_rating'] = $review['star_rating'] * 2;
            }
            if($review['review_date']) {
                $review['review_date'] = Carbon::parse($review['review_date'])->toDatetimeString();
            }

            unset($review['id']);
            unset($review['property_id']);

            $existingReview->fill($review);
            $existingReview->save();
        }
        unset($data['reviews']);

        $reviewsPage->fill($data);
        $reviewsPage->save();

        return Redirect::route('edit.reviews');
    }

    public static function getReviewsPageData(int $userID, bool $formatDate = false): array
    {
        $reviewsPage = User::find($userID)->property->reviewsPage;
        $data = $reviewsPage->toArray();

        $reviews = [];
        foreach ($reviewsPage->reviews as $review) {
            $reviewData = $review->toArray();
            if($reviewData['star_rating']) {
                $reviewData['star_rating'] = $reviewData['star_rating'] / 2;
            }
            if($reviewData['review_date'] && $formatDate) {
                $reviewData['review_date'] = Carbon::parse($reviewData['review_date'])->format('Y-m');
            }
            $reviews[] = $reviewData;

        }
        $data['reviews'] = $reviews;

        $data['reviews_page_section_image'] = ControllerServices::getImageIfExists($data['reviews_page_section_image']);

        return $data;
    }
}
