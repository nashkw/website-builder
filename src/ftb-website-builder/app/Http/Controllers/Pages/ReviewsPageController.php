<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerServices;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\WebsiteController;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ReviewsPageController extends Controller
{
    /**
     * Display a preview of the generated site reviews page.
     */
    public function preview(Request $request): Response
    {
        return Inertia::render(
            'GeneratedSite/ReviewsPreview',
            [
                'reviews_page' => $this->getReviewsPageData($request->user()->id),
                'property' => PropertyController::getPropertyData($request->user()->id),
                'website' => WebsiteController::getWebsiteData($request->user()->id),
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
            $this->getReviewsPageData($request->user()->id)
        );
    }

    /**
     * Update the user's generated site reviews page information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'reviews_page_section_header' => ['required', 'string', 'max:255'],
            'reviews_page_section_paragraph' => ['nullable', 'string', 'max:65535'],
            'reviews_page_section_image' => ['nullable', 'image'],
            'remove_reviews_page_section_image' => ['required', 'boolean'],
        ]);

        $reviewsPage = User::find($request->user()->id)->property->reviewsPage;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'reviews_page_section_image',
            'remove_reviews_page_section_image',
            'images/sectionImages/reviewsPrimary/',
            $reviewsPage,
            $data
        );

        $reviewsPage->fill($data);
        $reviewsPage->save();

        return Redirect::route('edit.reviews');
    }

    private function getReviewsPageData(int $userID): array
    {
        $reviewsPage = User::find($userID)->property->reviewsPage;
        $data = $reviewsPage->toArray();

        $reviews = [];
        foreach ($reviewsPage->reviews as $review) {
            $reviews[] = $review->toArray();
        }
        $data['reviews'] = $reviews;

        $data['reviews_page_section_image'] = ControllerServices::getImageIfExists($data['reviews_page_section_image']);

        return $data;
    }
}
