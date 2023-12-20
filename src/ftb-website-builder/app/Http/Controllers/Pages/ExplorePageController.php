<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ExplorePageController extends Controller
{
    /**
     * Display a preview of the generated site explore page.
     */
    public function preview(Request $request): Response
    {
        return Inertia::render(
            'GeneratedSite/ExplorePreview',
            ['explore_page' => $this->getExplorePageData($request->user()->id)]
        );
    }

    /**
     * Display the edit subpage for the generated site explore page.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render(
            'EditContent/EditExplore',
            $this->getExplorePageData($request->user()->id)
        );
    }

    /**
     * Update the user's generated site explore page information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'explore_page_section_header' => ['required', 'string', 'max:255'],
            'explore_page_section_paragraph' => ['required', 'string', 'max:65535'],
            'explore_page_section_image' => ['nullable', 'image'],
            'remove_explore_page_section_image' => ['required', 'boolean'],
        ]);

        $explorePage = User::find($request->user()->id)->property->explorePage;
        $data = $request->all();

        $data = PageControllerServices::uploadImage(
            $request,
            'explore_page_section_image',
            'remove_explore_page_section_image',
            'images/sectionImages/explorePrimary/',
            $explorePage,
            $data
        );

        $explorePage->fill($data);
        $explorePage->save();

        return Redirect::route('edit.explore');
    }

    private function getExplorePageData(int $userID): array
    {
        $explorePage = User::find($userID)->property->explorePage;
        $data = $explorePage->toArray();

        $attractions = [];
        foreach ($explorePage->attractions as $attraction) {
            $attractionData = $attraction->toArray();
            $attractionData['attraction_image'] = PageControllerServices::getImageIfExists($attractionData['attraction_image']);
            $attractions[] = $attractionData;
        }
        $data['attractions'] = $attractions;

        $data['explore_page_section_image'] = PageControllerServices::getImageIfExists($data['explore_page_section_image']);

        return $data;
    }
}
