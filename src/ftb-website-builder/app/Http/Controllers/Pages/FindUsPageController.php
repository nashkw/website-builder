<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerServices;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\WebsiteController;
use App\Http\Requests\PageUpdates\FindUsPageUpdateRequest;
use App\Models\FindUsPage\Direction;
use App\Models\User;
use App\Models\Website;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class FindUsPageController extends Controller
{
    /**
     * Display the generated site find us page.
     */
    public function display(Request $request): Response
    {
        $subdomain = $request->route()->parameters()['subdomain'];
        $user = Website::firstWhere('subdomain', $subdomain)->property->user_id;
        return Inertia::render(
            'GeneratedSite/FindUsPreview',
            [
                'find_us_page' => $this->getFindUsPageData($user),
                'property' => PropertyController::getPropertyData($user),
                'website' => WebsiteController::getWebsiteData($user),
                'routes' => ControllerServices::getRoutes('website', ['subdomain' => $subdomain]),
            ]
        );
    }

    /**
     * Display a preview of the generated site find us page.
     */
    public function preview(Request $request): Response
    {
        return Inertia::render(
            'GeneratedSite/FindUsPreview',
            [
                'find_us_page' => $this->getFindUsPageData($request->user()->id),
                'property' => PropertyController::getPropertyData($request->user()->id),
                'website' => WebsiteController::getWebsiteData($request->user()->id),
                'routes' => ControllerServices::getRoutes('preview'),
            ]
        );
    }

    /**
     * Display the edit subpage for the generated site find us page.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render(
            'EditContent/EditFindUs',
            $this->getFindUsPageData($request->user()->id)
        );
    }

    /**
     * Update the user's generated site find us page information.
     */
    public function update(FindUsPageUpdateRequest $request): RedirectResponse
    {
        $request->validated();

        $findUsPage = User::find($request->user()->id)->property->findUsPage;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'find_us_page_section_image',
            'remove_find_us_page_section_image',
            'images/sectionImages/findUsPrimary/',
            $findUsPage,
            $data
        );

        foreach ($data['directions_to_remove'] as $directionID) {
            Direction::find($directionID)->delete();
        }
        unset($data['directions_to_remove']);

        foreach ($data['directions'] as $direction) {
            if($direction['id']) {
                $existingDirection = Direction::find($direction['id']);
            } else {
                $existingDirection = new Direction;
                $existingDirection->property_id = $findUsPage->property_id;
            }

            unset($direction['id']);
            unset($direction['property_id']);

            $existingDirection->fill($direction);
            $existingDirection->save();
        }
        unset($data['directions']);

        $findUsPage->fill($data);
        $findUsPage->save();

        return Redirect::route('edit.findus');
    }

    private function getFindUsPageData(int $userID): array
    {
        $findUsPage = User::find($userID)->property->findUsPage;
        $data = $findUsPage->toArray();

        $directions = [];
        foreach ($findUsPage->directions as $direction) {
            $directions[] = $direction->toArray();
        }
        $data['directions'] = $directions;

        $data['find_us_page_section_image'] = ControllerServices::getImageIfExists($data['find_us_page_section_image']);

        return $data;
    }
}
