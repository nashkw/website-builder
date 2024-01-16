<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerServices;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\WebsiteController;
use App\Http\Requests\PageUpdates\HomePageUpdateRequest;
use App\Models\HomePage\SecondaryCoverImage;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class HomePageController extends Controller
{
    /**
     * Display a preview of the generated site home page.
     */
    public function preview(Request $request): Response
    {
        return Inertia::render(
            'GeneratedSite/HomePreview',
            [
                'home_page' => $this->getHomePageData($request->user()->id),
                'property' => PropertyController::getPropertyData($request->user()->id),
                'website' => WebsiteController::getWebsiteData($request->user()->id),
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

        $homePage = User::find($request->user()->id)->property->homePage;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'cover_image_primary',
            null,
            'images/coverImagePrimary/',
            $homePage,
            $data
        );
        $data = ControllerServices::uploadImage(
            $request,
            'intro_section_image',
            'remove_intro_section_image',
            'images/sectionImages/homeIntro/',
            $homePage,
            $data
        );
        $data = ControllerServices::uploadImage(
            $request,
            'welcome_section_image',
            'remove_welcome_section_image',
            'images/sectionImages/homeWelcome/',
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
                $filepath = Storage::disk("public")->putFile('images/coverImageSecondary/', $coverImage['secondary_cover_image']);
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

    private function getHomePageData(int $userID): array
    {
        $homePage = User::find($userID)->property->homePage;
        $data = $homePage->toArray();

        $secondaryCoverImages = [];
        foreach ($homePage->secondaryCoverImages as $coverImage) {
            $coverImageData = $coverImage->toArray();
            $coverImageData['secondary_cover_image'] = ControllerServices::getImageIfExists($coverImageData['secondary_cover_image']);
            $secondaryCoverImages[] = $coverImageData;
        }
        $data['secondary_cover_images'] = $secondaryCoverImages;

        $data['cover_image_primary'] = ControllerServices::getImageIfExists($data['cover_image_primary']);
        $data['intro_section_image'] = ControllerServices::getImageIfExists($data['intro_section_image']);
        $data['welcome_section_image'] = ControllerServices::getImageIfExists($data['welcome_section_image']);

        return $data;
    }
}
