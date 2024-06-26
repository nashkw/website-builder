<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerServices;
use App\Http\Controllers\PageFlagsController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\WebsiteController;
use App\Http\Requests\PageCreation\AboutPageCreationRequest;
use App\Http\Requests\PageUpdates\AboutPageUpdateRequest;
use App\Models\AboutPage\AboutPage;
use App\Models\AboutPage\SecondaryAboutSection;
use App\Models\User;
use App\Models\Website;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class AboutPageController extends Controller
{
    /**
     * Display the generated site about page.
     */
    public function display(Request $request): Response|RedirectResponse
    {
        $subdomain = $request->route()->parameters()['subdomain'];
        $website = Website::firstWhere('subdomain', $subdomain);
        if (!$website) {
            return Redirect::route('landing');
        } else if ($website->preview_only) {
            return Redirect::route('preview.about');
        }

        $user = $website->property->user_id;
        $page_flags = PageFlagsController::getPageFlagsData($user);
        if ($page_flags['has_about_page']) {
            return Inertia::render(
                'GeneratedSite/GenerateAbout',
                [
                    'about_page' => $this->getAboutPageData($user),
                    'property' => PropertyController::getPropertyData($user),
                    'website' => WebsiteController::getWebsiteData($user),
                    'page_flags' => $page_flags,
                    'routes' => ControllerServices::getRoutes('website', ['subdomain' => $subdomain]),
                    'isPreview' => false,
                ]
            );
        } else {
            return Redirect::route('website', ['subdomain' => $website->subdomain]);
        }
    }

    /**
     * Display a preview of the generated site about page.
     */
    public function preview(Request $request): Response|RedirectResponse
    {
        $website = User::find($request->user()->id)->property->website;
        if (!$website->preview_only) {
            return Redirect::route('website.about', ['subdomain' => $website->subdomain]);
        }

        $page_flags = PageFlagsController::getPageFlagsData($request->user()->id);
        if ($page_flags['has_about_page']) {
            return Inertia::render(
                'GeneratedSite/GenerateAbout',
                [
                    'about_page' => $this->getAboutPageData($request->user()->id),
                    'property' => PropertyController::getPropertyData($request->user()->id),
                    'website' => WebsiteController::getWebsiteData($request->user()->id),
                    'page_flags' => $page_flags,
                    'routes' => ControllerServices::getRoutes('preview'),
                    'isPreview' => true,
                ]
            );
        } else {
            return Redirect::route('preview');
        }
    }

    /**
     * Display the edit subpage for the generated site about page.
     */
    public function edit(Request $request): Response|RedirectResponse
    {
        $page_flags = PageFlagsController::getPageFlagsData($request->user()->id);

        if ($page_flags['has_about_page']) {
            return Inertia::render(
                'EditContent/EditAbout',
                $this->getAboutPageData($request->user()->id)
            );
        } else {
            return Redirect::route('add.about');
        }
    }

    /**
     * Display the add subpage for the generated site about page.
     */
    public function add(Request $request): Response|RedirectResponse
    {
        $page_flags = PageFlagsController::getPageFlagsData($request->user()->id);

        if ($page_flags['has_about_page']) {
            return Redirect::route('edit.about');
        } else {
            return Inertia::render('AddContent/AddAbout');
        }
    }

    /**
     * Create the user's generated site about page information.
     */
    public function create(AboutPageCreationRequest $request): RedirectResponse
    {
        $request->validated();

        $property = User::find($request->user()->id)->property;
        $imagePath = 'images/' . $property->id . '/';
        $aboutPage = new AboutPage;
        $aboutPage->property_id = $property->id;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'about_page_section_image',
            'remove_about_page_section_image',
            $imagePath,
            $aboutPage,
            $data
        );

        if (array_key_exists('secondary_about_sections', $data)) {
            foreach ($data['secondary_about_sections'] as $section) {
                $newSection = new SecondaryAboutSection;
                $newSection->property_id = $property->id;

                if (array_key_exists('remove_secondary_about_section_image', $section)) {
                    if ($section['remove_secondary_about_section_image']) {
                        $section['secondary_about_section_image'] = null;
                    }
                    unset($section['remove_secondary_about_section_image']);
                }

                if ($section['secondary_about_section_image']) {
                    $filepath = Storage::disk("public")->putFile($imagePath, $section['secondary_about_section_image']);
                    $section['secondary_about_section_image'] = $filepath;
                }

                $newSection->fill($section);
                $newSection->save();
            }
        }
        unset($data['secondary_about_sections']);

        $aboutPage->fill($data);
        $aboutPage->save();

        $pageFlags = $property->pageFlags;
        $pageFlags->has_about_page = true;
        $pageFlags->save();

        return Redirect::route('add');
    }

    /**
     * Update the user's generated site about page information.
     */
    public function update(AboutPageUpdateRequest $request): RedirectResponse
    {
        $request->validated();

        $imagePath = 'images/' . User::find($request->user()->id)->property->id . '/';
        $aboutPage = User::find($request->user()->id)->property->aboutPage;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'about_page_section_image',
            'remove_about_page_section_image',
            $imagePath,
            $aboutPage,
            $data
        );

        if ($request->has('secondary_about_sections_to_remove')) {
            foreach ($data['secondary_about_sections_to_remove'] as $sectionID) {
                $aboutSection = SecondaryAboutSection::find($sectionID);
                ControllerServices::deleteImage('secondary_about_section_image', $aboutSection);
                $aboutSection->delete();
            }
            unset($data['secondary_about_sections_to_remove']);
        }

        if (array_key_exists('secondary_about_sections', $data)) {
            foreach ($data['secondary_about_sections'] as $section) {
                if ($section['id']) {
                    $existingSection = SecondaryAboutSection::find($section['id']);
                } else {
                    $existingSection = new SecondaryAboutSection;
                    $existingSection->property_id = $aboutPage->property_id;
                }

                if (array_key_exists('remove_secondary_about_section_image', $section)) {
                    if ($section['remove_secondary_about_section_image']) {
                        if (is_string($section['secondary_about_section_image'])) {
                            ControllerServices::deleteImage('secondary_about_section_image', $existingSection);
                        }
                        $section['secondary_about_section_image'] = null;
                    }
                }

                if (is_string($section['secondary_about_section_image'])) {
                    unset($section['secondary_about_section_image']);
                } else if ($section['secondary_about_section_image']) {
                    $filepath = Storage::disk("public")->putFile($imagePath, $section['secondary_about_section_image']);
                    $section['secondary_about_section_image'] = $filepath;
                }

                unset($section['remove_secondary_about_section_image']);
                unset($section['id']);
                unset($section['property_id']);

                $existingSection->fill($section);
                $existingSection->save();
            }
        }
        unset($data['secondary_about_sections']);

        $aboutPage->fill($data);
        $aboutPage->save();

        return Redirect::route('edit.about');
    }

    public static function getAboutPageData(int $userID, bool $getURL = true): array
    {
        $aboutPage = User::find($userID)->property->aboutPage;
        $data = $aboutPage->toArray();

        $secondaryAboutSections = [];
        foreach ($aboutPage->secondaryAboutSections as $aboutSection) {
            $sectionData = $aboutSection->toArray();
            $sectionData['secondary_about_section_image'] = ControllerServices::getImageIfExists($sectionData['secondary_about_section_image'], $getURL);
            $secondaryAboutSections[] = $sectionData;
        }
        $data['secondary_about_sections'] = $secondaryAboutSections;

        $data['about_page_section_image'] = ControllerServices::getImageIfExists($data['about_page_section_image'], $getURL);

        return $data;
    }
}
