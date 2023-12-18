<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class AboutPageController extends Controller
{
    /**
     * Display the edit subpage for the generated site about page.
     */
    public function edit(Request $request): Response
    {
        $aboutPage = User::find($request->user()->id)->property->aboutPage;
        $secondaryAboutSections = [];
        foreach ($aboutPage->secondaryAboutSections as $aboutSection) {
            $secondaryAboutSections[] = [
                'secondary_about_section_header' => $aboutSection->secondary_about_section_header,
                'secondary_about_section_paragraph' => $aboutSection->secondary_about_section_paragraph,
                'secondary_about_section_image' => $this->getImageIfExists($aboutSection->secondary_about_section_image),
                'secondary_about_section_image_description' => $aboutSection->secondary_about_section_image_description,
            ];
        }

        return Inertia::render('EditContent/EditAbout', [
            'meta_page_title' => $aboutPage->meta_page_title,
            'meta_page_description' => $aboutPage->meta_page_description,
            'about_page_section_header' => $aboutPage->about_page_section_header,
            'about_page_section_paragraph' => $aboutPage->about_page_section_paragraph,
            'about_page_section_image' => $this->getImageIfExists($aboutPage->about_page_section_image),
            'about_page_section_image_description' => $aboutPage->about_page_section_image_description,
            'secondary_about_sections' => $secondaryAboutSections
        ]);
    }

    /**
     * Display a preview of the generated site home page.
     */
    public function preview(Request $request): Response
    {
        $aboutPage = User::find($request->user()->id)->property->aboutPage;
        $secondaryAboutSections = [];
        foreach ($aboutPage->secondaryAboutSections as $aboutSection) {
            $secondaryAboutSections[] = [
                'secondaryAboutSectionHeader' => $aboutSection->secondary_about_section_header,
                'secondaryAboutSectionParagraph' => $aboutSection->secondary_about_section_paragraph,
                'secondaryAboutSectionImage' => $this->getImageIfExists($aboutSection->secondary_about_section_image),
                'secondaryAboutSectionImageDescription' => $aboutSection->secondary_about_section_image_description,
            ];
        }

        return Inertia::render('GeneratedSite/AboutPreview', [
            'metaPageTitle' => $aboutPage->meta_page_title,
            'metaPageDescription' => $aboutPage->meta_page_description,
            'aboutPageSectionHeader' => $aboutPage->about_page_section_header,
            'aboutPageSectionParagraph' => $aboutPage->about_page_section_paragraph,
            'aboutPageSectionImage' => $this->getImageIfExists($aboutPage->about_page_section_image),
            'aboutPageSectionImageDescription' => $aboutPage->about_page_section_image_description,
            'secondaryAboutSections' => $secondaryAboutSections
        ]);
    }

    /**
     * Update the user's generated site home page information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'about_page_section_header' => ['required', 'string', 'max:255'],
            'about_page_section_paragraph' => ['required', 'string', 'max:65535'],
            'about_page_section_image' => ['nullable', 'image'],
            'remove_about_page_section_image' => ['required', 'boolean'],
            'about_page_section_image_description' => ['required', 'string', 'max:255'],
        ]);

        $aboutPage = User::find($request->user()->id)->property->aboutPage;
        $data = $request->all();

        $data = $this->uploadImage(
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

    private function getImageIfExists (?string $path): ?string
    {
        if($path && Storage::disk('public')->exists($path)) {
            return Storage::url($path);
        }
        return null;
    }

    private function deleteImage (string $field, AboutPage $currentData) : void
    {
        if ($currentData[$field]) {
            Storage::disk("public")->delete($currentData[$field]);
        }
    }

    private function uploadImage (
        Request $request,
        string $field,
        ?string $shouldDelete,
        string $path,
        AboutPage $currentData,
        array $data
    ): array
    {
        if($shouldDelete) {
            if ($request[$shouldDelete] || $request[$field]) {
                $this->deleteImage($field, $currentData);
                $data[$field] = null;
            }
            unset($data[$shouldDelete]);
        }
        if ($request[$field]) {
            $filepath = Storage::disk("public")->putFile($path, $request[$field]);
            $data[$field] = $filepath;
        }
        else {
            unset($data[$field]);
        }
        return $data;
    }
}
