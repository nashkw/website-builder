<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerServices;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class AboutPageController extends Controller
{
    /**
     * Display a preview of the generated site about page.
     */
    public function preview(Request $request): Response
    {
        return Inertia::render(
            'GeneratedSite/AboutPreview',
            ['about_page' => $this->getAboutPageData($request->user()->id)]
        );
    }

    /**
     * Display the edit subpage for the generated site about page.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render(
            'EditContent/EditAbout',
            $this->getAboutPageData($request->user()->id)
        );
    }

    /**
     * Update the user's generated site about page information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'about_page_section_header' => ['required', 'string', 'max:255'],
            'about_page_section_paragraph' => ['required', 'string', 'max:65535'],
            'about_page_section_image' => ['nullable', 'image'],
            'remove_about_page_section_image' => ['required', 'boolean'],
        ]);

        $aboutPage = User::find($request->user()->id)->property->aboutPage;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'about_page_section_image',
            'remove_about_page_section_image',
            'images/sectionImages/aboutPrimary/',
            $aboutPage,
            $data
        );

        $aboutPage->fill($data);
        $aboutPage->save();

        return Redirect::route('edit.about');
    }

    private function getAboutPageData(int $userID): array
    {
        $aboutPage = User::find($userID)->property->aboutPage;
        $data = $aboutPage->toArray();

        $secondaryAboutSections = [];
        foreach ($aboutPage->secondaryAboutSections as $aboutSection) {
            $sectionData = $aboutSection->toArray();
            $sectionData['secondary_about_section_image'] = ControllerServices::getImageIfExists($sectionData['secondary_about_section_image']);
            $secondaryAboutSections[] = $sectionData;
        }
        $data['secondary_about_sections'] = $secondaryAboutSections;

        $data['about_page_section_image'] = ControllerServices::getImageIfExists($data['about_page_section_image']);

        return $data;
    }
}
