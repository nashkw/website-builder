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
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ZipArchive;

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
     * Download the user's website as a standalone app.
     */
    public function download(Request $request): BinaryFileResponse
    {
        $userID = $request->user()->id;
        $zip = new ZipArchive();
        $zipPath = public_path('website.zip');
        $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // add generated site app
        $sitePath = realpath(base_path('generated-site'));
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($sitePath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($sitePath) + 1);
                if (!str_contains($relativePath, 'src/data/')
                    && !str_contains($relativePath, 'node_modules/')
                    && !str_contains($relativePath, '.idea/')
                ) {
                    $zip->addFile($filePath, $relativePath);
                }
            }
        }

        // add user images
        $imagesPath = realpath(base_path('storage/app/public/images/' . User::find($userID)->property->id . '/'));
        $images = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($imagesPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($images as $image) {
            if (!$image->isDir()) {
                $filePath = $image->getRealPath();
                $zip->addFile($filePath, 'src/data/images/' . basename($filePath));
            }
        }

        // add user data
        $data = json_encode([
            'home_page' => HomePageController::getHomePageData($userID, false),
            'rooms_page' => RoomsPageController::getRoomsPageData($userID, false),
            'reviews_page' => ReviewsPageController::getReviewsPageData($userID, false, false),
            'about_page' => AboutPageController::getAboutPageData($userID, false),
            'explore_page' => ExplorePageController::getExplorePageData($userID, false),
            'find_us_page' => FindUsPageController::getFindUsPageData($userID, false),
            'faq_page' => FAQPageController::getFAQPageData($userID, false),
            'property' => PropertyController::getPropertyData($userID, false),
            'website' => WebsiteController::getWebsiteData($userID, false),
        ]);
        $zip->addFromString('src/data/data.json', $data);

        $zip->close();
        return response()->download($zipPath)->deleteFileAfterSend();
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
