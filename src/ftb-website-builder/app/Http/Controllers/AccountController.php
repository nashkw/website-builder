<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Pages\AboutPageController;
use App\Http\Controllers\Pages\ExplorePageController;
use App\Http\Controllers\Pages\FAQPageController;
use App\Http\Controllers\Pages\FindUsPageController;
use App\Http\Controllers\Pages\HomePageController;
use App\Http\Controllers\Pages\ReviewsPageController;
use App\Http\Controllers\Pages\RoomsPageController;
use App\Http\Requests\AccountUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class AccountController extends Controller
{
    /**
     * Display the user's account form.
     */
    public function edit(Request $request): Response
    {
        $subdomain = User::find($request->user()->id)->property->website->subdomain;
        return Inertia::render('Account/Account', ['subdomain' => $subdomain]);
    }

    /**
     * Download the user's website data.
     */
    public function download(Request $request): \Illuminate\Http\Response
    {
        $userID = $request->user()->id;
        $file = json_encode([
            'home_page' => HomePageController::getHomePageData($userID),
            'rooms_page' => RoomsPageController::getRoomsPageData($userID),
            'reviews_page' => ReviewsPageController::getReviewsPageData($userID),
            'about_page' => AboutPageController::getAboutPageData($userID),
            'explore_page' => ExplorePageController::getExplorePageData($userID),
            'find_us_page' => FindUsPageController::getFindUsPageData($userID),
            'faq_page' => FAQPageController::getFAQPageData($userID),
            'property' => PropertyController::getPropertyData($userID),
            'website' => WebsiteController::getWebsiteData($userID),
        ]);
        return response($file, 200, ['Content-Disposition' => 'attachment; filename="data.json"']);
    }

    /**
     * Update the user's account information.
     */
    public function update(AccountUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        $request->user()->save();

        return Redirect::route('account');
    }

    /**
     * Update the user's subdomain information.
     */
    public function subdomain(Request $request): RedirectResponse
    {
        $request->validate([ 'subdomain' => [
            'required',
            'string',
            'lowercase',
            'alpha_dash',
            Rule::unique('websites')->ignore(User::find($request->user()->id)->property->id, 'property_id'),
        ]]);

        $website = User::find($request->user()->id)->property->website;
        $website->fill($request->all());
        $website->save();

        return Redirect::route('account');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
