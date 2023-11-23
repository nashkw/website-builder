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
            $homePage->property->id,
            'cover_image_primary',
            'coverImagePrimary',
            $updatedData
        );
        if($request['intro_section_image']) {
            $updatedData = $this->uploadImage(
                $request,
                $homePage->property->id,
                'intro_section_image',
                'sectionImages/homeIntro',
                $updatedData
            );
        }
        if($request['welcome_section_image']) {
            $updatedData = $this->uploadImage(
                $request,
                $homePage->property->id,
                'welcome_section_image',
                'sectionImages/homeWelcome',
                $updatedData
            );
        }

        $homePage->fill($updatedData);
        $homePage->save();

        return Redirect::route('edit.home');
    }

    private function uploadImage ($request, $id, $field, $path, $data): Array
    {
        $filename = $id . "_" . time() . "." . $request[$field]->extension();
        $request[$field]->move(public_path($path), $filename);
        $data[$field] = $filename;
        return $data;
    }
}
