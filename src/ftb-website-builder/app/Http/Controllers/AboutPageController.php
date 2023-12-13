<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\HomePage;
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
