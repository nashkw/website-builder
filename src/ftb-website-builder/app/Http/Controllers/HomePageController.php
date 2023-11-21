<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
            'intro_section_header' => ['required', 'string', 'max:255'],
            'intro_section_paragraph' => ['required', 'string', 'max:65535'],
            'welcome_section_header' => ['required', 'string', 'max:255'],
            'welcome_section_paragraph' => ['required', 'string', 'max:65535'],
        ]);

        $homePage = User::find($request->user()->id)->property->homePage;
        $homePage->fill($request->all());
        $homePage->save();

        return Redirect::route('edit.home');
    }
}
