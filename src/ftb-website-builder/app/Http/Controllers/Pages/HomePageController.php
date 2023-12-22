<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerServices;
use App\Http\Controllers\PropertyController;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'cover_image_primary' => ['nullable', 'image'],
            'intro_section_header' => ['required', 'string', 'max:255'],
            'intro_section_paragraph' => ['required', 'string', 'max:65535'],
            'intro_section_image' => ['nullable', 'image'],
            'remove_intro_section_image' => ['required', 'boolean'],
            'welcome_section_header' => ['required', 'string', 'max:255'],
            'welcome_section_paragraph' => ['required', 'string', 'max:65535'],
            'welcome_section_image' => ['nullable', 'image'],
            'remove_welcome_section_image' => ['required', 'boolean'],
        ]);

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
