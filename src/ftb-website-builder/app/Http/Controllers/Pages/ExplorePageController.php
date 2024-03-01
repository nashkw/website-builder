<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerServices;
use App\Http\Controllers\PageFlagsController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\WebsiteController;
use App\Http\Requests\PageCreation\ExplorePageCreationRequest;
use App\Http\Requests\PageUpdates\ExplorePageUpdateRequest;
use App\Models\ExplorePage\Attraction;
use App\Models\ExplorePage\ExplorePage;
use App\Models\User;
use App\Models\Website;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ExplorePageController extends Controller
{
    /**
     * Display the generated site explore page.
     */
    public function display(Request $request): Response|RedirectResponse
    {
        $subdomain = $request->route()->parameters()['subdomain'];
        $website = Website::firstWhere('subdomain', $subdomain);
        if (!$website) {
            return Redirect::route('landing');
        } else if ($website->preview_only) {
            return Redirect::route('preview.explore');
        }

        $user = $website->property->user_id;
        $page_flags = PageFlagsController::getPageFlagsData($user);
        if ($page_flags['has_explore_page']) {
            return Inertia::render(
                'GeneratedSite/GenerateExplore',
                [
                    'explore_page' => $this->getExplorePageData($user),
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
     * Display a preview of the generated site explore page.
     */
    public function preview(Request $request): Response|RedirectResponse
    {
        $website = User::find($request->user()->id)->property->website;
        if (!$website->preview_only) {
            return Redirect::route('website.explore', ['subdomain' => $website->subdomain]);
        }

        $page_flags = PageFlagsController::getPageFlagsData($request->user()->id);
        if ($page_flags['has_explore_page']) {
            return Inertia::render(
                'GeneratedSite/GenerateExplore',
                [
                    'explore_page' => $this->getExplorePageData($request->user()->id),
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
     * Display the edit subpage for the generated site explore page.
     */
    public function edit(Request $request): Response|RedirectResponse
    {
        $page_flags = PageFlagsController::getPageFlagsData($request->user()->id);

        if ($page_flags['has_explore_page']) {
            return Inertia::render(
                'EditContent/EditExplore',
                $this->getExplorePageData($request->user()->id)
            );
        } else {
            return Redirect::route('add.explore');
        }
    }

    /**
     * Display the add subpage for the generated site explore page.
     */
    public function add(Request $request): Response|RedirectResponse
    {
        $page_flags = PageFlagsController::getPageFlagsData($request->user()->id);

        if ($page_flags['has_explore_page']) {
            return Redirect::route('edit.explore');
        } else {
            return Inertia::render('AddContent/AddExplore');
        }
    }

    /**
     * Create the user's generated site explore page information.
     */
    public function create(ExplorePageCreationRequest $request): RedirectResponse
    {
        $request->validated();

        $property = User::find($request->user()->id)->property;
        $imagePath = 'images/' . $property->id . '/';
        $explorePage = new ExplorePage;
        $explorePage->property_id = $property->id;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'explore_page_section_image',
            'remove_explore_page_section_image',
            $imagePath,
            $explorePage,
            $data
        );

        if (array_key_exists('attractions', $data)) {
            foreach ($data['attractions'] as $attraction) {
                $newAttraction = new Attraction;
                $newAttraction->property_id = $property->id;

                if (array_key_exists('remove_attraction_image', $attraction)) {
                    if ($attraction['remove_attraction_image']) {
                        $attraction['attraction_image'] = null;
                    }
                    unset($attraction['remove_attraction_image']);
                }

                if ($attraction['attraction_image']) {
                    $filepath = Storage::disk("public")->putFile($imagePath, $attraction['attraction_image']);
                    $attraction['attraction_image'] = $filepath;
                }

                $newAttraction->fill($attraction);
                $newAttraction->save();
            }
        }
        unset($data['attractions']);

        $explorePage->fill($data);
        $explorePage->save();

        $pageFlags = $property->pageFlags;
        $pageFlags->has_explore_page = true;
        $pageFlags->save();

        return Redirect::route('add');
    }

    /**
     * Update the user's generated site explore page information.
     */
    public function update(ExplorePageUpdateRequest $request): RedirectResponse
    {
        $request->validated();

        $imagePath = 'images/' . User::find($request->user()->id)->property->id . '/';
        $explorePage = User::find($request->user()->id)->property->explorePage;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'explore_page_section_image',
            'remove_explore_page_section_image',
            $imagePath,
            $explorePage,
            $data
        );

        if ($request->has('attractions_to_remove')) {
            foreach ($data['attractions_to_remove'] as $attractionID) {
                $attractionSection = Attraction::find($attractionID);
                ControllerServices::deleteImage('attraction_image', $attractionSection);
                $attractionSection->delete();
            }
            unset($data['attractions_to_remove']);
        }

        if (array_key_exists('attractions', $data)) {
            foreach ($data['attractions'] as $attraction) {
                if ($attraction['id']) {
                    $existingAttraction = Attraction::find($attraction['id']);
                } else {
                    $existingAttraction = new Attraction;
                    $existingAttraction->property_id = $explorePage->property_id;
                }

                if (array_key_exists('remove_attraction_image', $attraction)) {
                    if ($attraction['remove_attraction_image']) {
                        if (is_string($attraction['attraction_image'])) {
                            ControllerServices::deleteImage('attraction_image', $existingAttraction);
                        }
                        $attraction['attraction_image'] = null;
                    }
                }

                if (is_string($attraction['attraction_image'])) {
                    unset($attraction['attraction_image']);
                } else if ($attraction['attraction_image']) {
                    $filepath = Storage::disk("public")->putFile($imagePath, $attraction['attraction_image']);
                    $attraction['attraction_image'] = $filepath;
                }

                unset($attraction['remove_attraction_image']);
                unset($attraction['id']);
                unset($attraction['property_id']);

                $existingAttraction->fill($attraction);
                $existingAttraction->save();
            }
        }
        unset($data['attractions']);

        $explorePage->fill($data);
        $explorePage->save();

        return Redirect::route('edit.explore');
    }

    public static function getExplorePageData(int $userID, bool $getURL = true): array
    {
        $explorePage = User::find($userID)->property->explorePage;
        $data = $explorePage->toArray();

        $attractions = [];
        foreach ($explorePage->attractions as $attraction) {
            $attractionData = $attraction->toArray();
            $attractionData['attraction_image'] = ControllerServices::getImageIfExists($attractionData['attraction_image'], $getURL);
            $attractions[] = $attractionData;
        }
        $data['attractions'] = $attractions;

        $data['explore_page_section_image'] = ControllerServices::getImageIfExists($data['explore_page_section_image'], $getURL);

        return $data;
    }
}
