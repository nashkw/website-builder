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

class FindUsPageController extends Controller
{
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
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'find_us_page_section_header' => ['required', 'string', 'max:255'],
            'find_us_page_section_paragraph' => ['required', 'string', 'max:65535'],
            'find_us_page_section_image' => ['nullable', 'image'],
            'remove_find_us_page_section_image' => ['required', 'boolean'],
        ]);

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
