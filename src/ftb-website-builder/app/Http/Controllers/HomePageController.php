<?php

namespace App\Http\Controllers;

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
            'currentIntroSectionHeader' => $homePage->intro_section_header,
            'currentIntroSectionParagraph' => $homePage->intro_section_paragraph,
            'currentWelcomeSectionHeader' => $homePage->welcome_section_header,
            'currentWelcomeSectionParagraph' => $homePage->welcome_section_paragraph,
        ]);
    }

    /**
     * Update the user's generated site home page information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'cover_image_primary' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:10240'],
            'intro_section_header' => ['required', 'string', 'max:255'],
            'intro_section_paragraph' => ['required', 'string', 'max:65535'],
            'intro_section_image' => ['nullable', 'mimes:jpg,jpeg,png,gif', 'max:10240'],
            'welcome_section_header' => ['required', 'string', 'max:255'],
            'welcome_section_paragraph' => ['required', 'string', 'max:65535'],
            'welcome_section_image' => ['nullable', 'mimes:jpg,jpeg,png,gif', 'max:10240'],
        ]);

        $homePage = User::find($request->user()->id)->property->homePage;
        $updatedData = $request->all();

        $updatedData = $this->uploadImage(
            $request,
            'cover_image_primary',
            'images/coverImagePrimary/',
            $homePage,
            $updatedData
        );
        $updatedData = $this->uploadImage(
            $request,
            'intro_section_image',
            'images/sectionImages/homeIntro/',
            $homePage,
            $updatedData
        );
        $updatedData = $this->uploadImage(
            $request,
            'welcome_section_image',
            'images/sectionImages/homeWelcome/',
            $homePage,
            $updatedData
        );

        $homePage->fill($updatedData);
        $homePage->save();

        return Redirect::route('edit.home');
    }

    private function uploadImage (Request $request, string $field, string $path, $currentData, $updatedData): Array
    {
        if ($request[$field]) {
            if ($currentData[$field]) {
                Storage::disk("public")->delete($currentData[$field]);
            }
            $filepath = Storage::disk("public")->putFile($path, $request[$field]);
            $updatedData[$field] = $filepath;
        }
        else {
            unset($updatedData[$field]);
        }
        return $updatedData;
    }
}
