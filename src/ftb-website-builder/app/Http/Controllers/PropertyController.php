<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use PHP_ICO;

class PropertyController
{
    /**
     * Display the edit subpage for property details.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render(
            'EditContent/EditProperty',
            $this->getPropertyData($request->user()->id)
        );
    }

    /**
     * Update the user's property details.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'property_name' => ['required', 'string', 'max:255'],
            'property_address_line_1' => ['required', 'string', 'max:255'],
            'property_address_line_2' => ['nullable', 'string', 'max:255'],
            'property_address_area' => ['required', 'string', 'max:255'],
            'property_address_country' => ['required', 'string', 'max:255'],
            'property_address_postcode' => ['required', 'string', 'max:255'],
            'property_telephone' => ['required', 'string', 'max:255'],
            'property_email' => ['required', 'string', 'max:255'],
            'property_twitter_link' => ['nullable', 'string', 'max:255'],
            'property_youtube_link' => ['nullable', 'string', 'max:255'],
            'property_linkedin_link' => ['nullable', 'string', 'max:255'],
            'property_facebook_link' => ['nullable', 'string', 'max:255'],
            'property_instagram_link' => ['nullable', 'string', 'max:255'],
            'property_tripadvisor_link' => ['nullable', 'string', 'max:255'],
            'property_logo' => ['nullable', 'image'],
            'remove_property_logo' => ['required', 'boolean'],
            'property_booking_link' => ['required', 'string', 'max:255'],
        ]);

        $imagePath = 'images/' . User::find($request->user()->id)->property->id . '/';
        $property = User::find($request->user()->id)->property;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'property_logo',
            'remove_property_logo',
            $imagePath,
            $property,
            $data
        );
        if (!$request->remove_property_logo && $data['property_logo']) {
            $sizes = array(array(16, 16), array(24, 24), array(32, 32), array(48, 48));
            $ico = new PHP_ICO(public_path('storage/' . $data['property_logo']), $sizes);
            $ico->save_ico(public_path('storage/' . $imagePath . 'favicon.ico'));
            $data['property_favicon'] = $imagePath . 'favicon.ico';
        } else if ($property->property_favicon && $request->remove_property_logo) {
            Storage::disk("public")->delete($property->property_favicon);
            $data['property_favicon'] = null;
        }

        $property->fill($data);
        $property->save();

        return Redirect::route('edit.property');
    }

    public static function getPropertyData(int $userID, bool $getURL = true): array
    {
        $data = User::find($userID)->property->toArray();
        $data['property_logo'] = ControllerServices::getImageIfExists($data['property_logo'], $getURL);
        $data['property_favicon'] = ControllerServices::getImageIfExists($data['property_favicon'], $getURL);
        return $data;
    }
}
