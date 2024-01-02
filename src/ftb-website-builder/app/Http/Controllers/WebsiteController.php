<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class WebsiteController
{
    /**
     * Display the edit subpage for website details.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render(
            'EditContent/EditWebsite',
            $this->getWebsiteData($request->user()->id)
        );
    }

    /**
     * Update the user's website details.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'primary_colour' => ['required', 'string', 'max:6'],
            'secondary_colour' => ['required', 'string', 'max:6'],
            'background_colour' => ['required', 'string', 'max:6'],
            'text_colour' => ['required', 'string', 'max:6'],
            'divider_art' => ['nullable', 'image'],
            'remove_divider_art' => ['required', 'boolean'],
            'font_family' => ['nullable', 'string', 'max:255'],
        ]);

        $website = User::find($request->user()->id)->website;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'divider_art',
            'remove_divider_art',
            'images/dividerArt/',
            $website,
            $data
        );

        $website->fill($data);
        $website->save();

        return Redirect::route('edit.website');
    }

    public static function getWebsiteData(int $userID): array
    {
        $data = User::find($userID)->property->website->toArray();
        $data['divider_art'] = ControllerServices::getImageIfExists($data['divider_art']);
        return $data;
    }
}