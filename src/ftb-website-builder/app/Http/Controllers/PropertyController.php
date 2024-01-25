<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

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

        $property->fill($data);
        $property->save();

        return Redirect::route('edit.property');
    }

    public static function getPropertyData(int $userID): array
    {
        $data = User::find($userID)->property->toArray();
        $data['property_logo'] = ControllerServices::getImageIfExists($data['property_logo']);
        return $data;
    }
}
