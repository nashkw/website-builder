<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerServices;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\WebsiteController;
use App\Http\Requests\PageUpdates\HomePageUpdateRequest;
use App\Models\HomePage\SecondaryCoverImage;
use App\Models\User;
use App\Models\Website;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class HomePageController extends Controller
{
    /**
     * Display the generated site home page.
     */
    public function display(Request $request): Response|RedirectResponse
    {
        $subdomain = $request->route()->parameters()['subdomain'];
        $website = Website::firstWhere('subdomain', $subdomain);
        if (!$website) {
            return Redirect::route('landing');
        } else if ($website->preview_only) {
            return Redirect::route('preview');
        }

        $user = $website->property->user_id;
        return Inertia::render(
            'GeneratedSite/GenerateHome',
            [
                'home_page' => $this->getHomePageData($user),
                'property' => PropertyController::getPropertyData($user),
                'website' => WebsiteController::getWebsiteData($user),
                'routes' => ControllerServices::getRoutes('website', ['subdomain' => $subdomain]),
                'isPreview' => false,
            ]
        );
    }

    /**
     * Display a preview of the generated site home page.
     */
    public function preview(Request $request): Response|RedirectResponse
    {
        $website = User::find($request->user()->id)->property->website;
        if (!$website->preview_only) {
            return Redirect::route('website', ['subdomain' => $website->subdomain]);
        }

        return Inertia::render(
            'GeneratedSite/GenerateHome',
            [
                'home_page' => $this->getHomePageData($request->user()->id),
                'property' => PropertyController::getPropertyData($request->user()->id),
                'website' => WebsiteController::getWebsiteData($request->user()->id),
                'routes' => ControllerServices::getRoutes('preview'),
                'isPreview' => true,
            ]
        );
    }

    /**
     * Display the edit subpage for the generated site home page.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render(
            'EditContent/EditHome',
            $this->getHomePageData($request->user()->id)
        );
    }

    /**
     * Update the user's generated site home page information.
     */
    public function update(HomePageUpdateRequest $request): RedirectResponse
    {
        $request->validated();

        $imagePath = 'images/' . User::find($request->user()->id)->property->id . '/';
        $homePage = User::find($request->user()->id)->property->homePage;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'cover_image_primary',
            null,
            $imagePath,
            $homePage,
            $data
        );
        $data = ControllerServices::uploadImage(
            $request,
            'intro_section_image',
            'remove_intro_section_image',
            $imagePath,
            $homePage,
            $data
        );
        $data = ControllerServices::uploadImage(
            $request,
            'welcome_section_image',
            'remove_welcome_section_image',
            $imagePath,
            $homePage,
            $data
        );

        if($request->has('secondary_cover_images_to_remove')) {
            foreach ($data['secondary_cover_images_to_remove'] as $coverImageID) {
                $coverImage = SecondaryCoverImage::find($coverImageID);
                ControllerServices::deleteImage('secondary_cover_image', $coverImage);
                $coverImage->delete();
            }
            unset($data['secondary_cover_images_to_remove']);
        }

        foreach ($data['secondary_cover_images'] as $coverImage) {
            if($coverImage['id']) {
                $existingCoverImage = SecondaryCoverImage::find($coverImage['id']);
            } else {
                $existingCoverImage = new SecondaryCoverImage;
                $existingCoverImage->property_id = $homePage->property_id;
            }

            if(!is_string($coverImage['secondary_cover_image'])) {
                $filepath = Storage::disk("public")->putFile($imagePath, $coverImage['secondary_cover_image']);
                $coverImage['secondary_cover_image'] = $filepath;

                unset($coverImage['id']);
                unset($coverImage['property_id']);

                $existingCoverImage->fill($coverImage);
                $existingCoverImage->save();
            }
        }
        unset($data['secondary_cover_images']);

        $homePage->fill($data);
        $homePage->save();

        return Redirect::route('edit.home');
    }

    public static function getHomePageData(int $userID, bool $getURL = true): array
    {
        $homePage = User::find($userID)->property->homePage;
        $data = $homePage->toArray();

        $secondaryCoverImages = [];
        foreach ($homePage->secondaryCoverImages as $coverImage) {
            $coverImageData = $coverImage->toArray();
            $coverImageData['secondary_cover_image'] = ControllerServices::getImageIfExists($coverImageData['secondary_cover_image'], $getURL);
            $secondaryCoverImages[] = $coverImageData;
        }
        $data['secondary_cover_images'] = $secondaryCoverImages;

        $data['cover_image_primary'] = ControllerServices::getImageIfExists($data['cover_image_primary'], $getURL);
        $data['intro_section_image'] = ControllerServices::getImageIfExists($data['intro_section_image'], $getURL);
        $data['welcome_section_image'] = ControllerServices::getImageIfExists($data['welcome_section_image'], $getURL);

        return $data;
    }
}
