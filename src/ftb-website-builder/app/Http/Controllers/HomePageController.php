<?php

namespace App\Http\Controllers;

use App\Models\HomePage;
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
     * Display the edit subpage for the generated site home page.
     */
    public function edit(Request $request): Response
    {
        $homePage = User::find($request->user()->id)->property->homePage;
        return Inertia::render('EditContent/EditHome', [
            'currentCoverImagePrimary' => $this->getImageIfExists($homePage->cover_image_primary),
            'currentIntroSectionHeader' => $homePage->intro_section_header,
            'currentIntroSectionParagraph' => $homePage->intro_section_paragraph,
            'currentIntroSectionImage' => $this->getImageIfExists($homePage->intro_section_image),
            'currentWelcomeSectionHeader' => $homePage->welcome_section_header,
            'currentWelcomeSectionParagraph' => $homePage->welcome_section_paragraph,
            'currentWelcomeSectionImage' => $this->getImageIfExists($homePage->welcome_section_image),
        ]);
    }

    /**
     * Display a preview of the generated site home page.
     */
    public function preview(Request $request): Response
    {
        $homePage = User::find($request->user()->id)->property->homePage;
        $secondaryCoverImages = [];
        foreach ($homePage->secondaryCoverImages as $coverImage) {
            $secondaryCoverImages[] = [
                'secondaryCoverImage' => $this->getImageIfExists($coverImage->secondary_cover_image),
                'secondaryCoverImageDescription' => $coverImage->secondary_cover_image_description,
            ];
        }
        return Inertia::render('GeneratedSite/Home', [
            'propertyName' => $homePage->property->property_name,
            'metaPageTitle' => $homePage->meta_page_title,
            'metaPageDescription' => $homePage->meta_page_description,
            'coverImagePrimary' => $this->getImageIfExists($homePage->cover_image_primary),
            'coverImagePrimaryDescription' => $homePage->cover_image_primary_description,
            'introSectionHeader' => $homePage->intro_section_header,
            'introSectionParagraph' => $homePage->intro_section_paragraph,
            'introSectionImage' => $this->getImageIfExists($homePage->intro_section_image),
            'introSectionImageDescription' => $homePage->intro_section_image_description,
            'welcomeSectionHeader' => $homePage->welcome_section_header,
            'welcomeSectionParagraph' => $homePage->welcome_section_paragraph,
            'welcomeSectionImage' => $this->getImageIfExists($homePage->welcome_section_image),
            'welcomeSectionImageDescription' => $homePage->welcome_section_image_description,
            'secondaryCoverImages' => $secondaryCoverImages,
        ]);
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

        $data = $this->uploadImage(
            $request,
            'cover_image_primary',
            null,
            'images/coverImagePrimary/',
            $homePage,
            $data
        );
        $data = $this->uploadImage(
            $request,
            'intro_section_image',
            'remove_intro_section_image',
            'images/sectionImages/homeIntro/',
            $homePage,
            $data
        );
        $data = $this->uploadImage(
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

    private function getImageIfExists (?string $path): ?string
    {
        if($path && Storage::disk('public')->exists($path)) {
            return Storage::url($path);
        }
        return null;
    }

    private function deleteImage (string $field, HomePage $currentData) : void
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
        HomePage $currentData,
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
