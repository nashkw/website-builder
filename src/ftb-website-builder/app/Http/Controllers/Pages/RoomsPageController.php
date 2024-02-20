<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerServices;
use App\Http\Controllers\PageFlagsController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\WebsiteController;
use App\Http\Requests\PageUpdates\RoomsPageUpdateRequest;
use App\Models\RoomsPage\Room;
use App\Models\RoomsPage\SecondaryRoomImage;
use App\Models\User;
use App\Models\Website;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class RoomsPageController extends Controller
{
    /**
     * Display the generated site rooms page.
     */
    public function display(Request $request): Response|RedirectResponse
    {
        $subdomain = $request->route()->parameters()['subdomain'];
        $website = Website::firstWhere('subdomain', $subdomain);
        if (!$website) {
            return Redirect::route('landing');
        } else if ($website->preview_only) {
            return Redirect::route('preview.rooms');
        }

        $user = $website->property->user_id;
        return Inertia::render(
            'GeneratedSite/GenerateRooms',
            [
                'rooms_page' => $this->getRoomsPageData($user),
                'property' => PropertyController::getPropertyData($user),
                'website' => WebsiteController::getWebsiteData($user),
                'page_flags' => PageFlagsController::getPageFlagsData($user),
                'routes' => ControllerServices::getRoutes('website', ['subdomain' => $subdomain]),
                'isPreview' => false,
            ]
        );
    }

    /**
     * Display a preview of the generated site rooms page.
     */
    public function preview(Request $request): Response|RedirectResponse
    {
        $website = User::find($request->user()->id)->property->website;
        if (!$website->preview_only) {
            return Redirect::route('website.rooms', ['subdomain' => $website->subdomain]);
        }

        return Inertia::render(
            'GeneratedSite/GenerateRooms',
            [
                'rooms_page' => $this->getRoomsPageData($request->user()->id),
                'property' => PropertyController::getPropertyData($request->user()->id),
                'website' => WebsiteController::getWebsiteData($request->user()->id),
                'page_flags' => PageFlagsController::getPageFlagsData($request->user()->id),
                'routes' => ControllerServices::getRoutes('preview'),
                'isPreview' => true,
            ]
        );
    }

    /**
     * Display the edit subpage for the generated site rooms page.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render(
            'EditContent/EditRooms',
            $this->getRoomsPageData($request->user()->id)
        );
    }

    /**
     * Update the user's generated site rooms page information.
     */
    public function update(RoomsPageUpdateRequest $request): RedirectResponse
    {
        $request->validated();

        $imagePath = 'images/' . User::find($request->user()->id)->property->id . '/';
        $roomsPage = User::find($request->user()->id)->property->roomsPage;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'rooms_page_section_image',
            'remove_rooms_page_section_image',
            $imagePath,
            $roomsPage,
            $data
        );

        if ($request->has('rooms_to_remove')) {
            foreach ($data['rooms_to_remove'] as $attractionID) {
                $attractionSection = Room::find($attractionID);
                ControllerServices::deleteImage('room_image_primary', $attractionSection);
                $attractionSection->delete();
            }
            unset($data['rooms_to_remove']);
        }

        foreach ($data['rooms'] as $room) {
            if ($room['id']) {
                $existingRoom = Room::find($room['id']);
            } else {
                $existingRoom = new Room;
                $existingRoom->property_id = $roomsPage->property_id;
            }

            if (is_string($room['room_image_primary'])) {
                unset($room['room_image_primary']);
            } else if ($room['room_image_primary']) {
                $filepath = Storage::disk("public")->putFile($imagePath, $room['room_image_primary']);
                $room['room_image_primary'] = $filepath;
            }

            if(array_key_exists('secondary_room_images_to_remove', $room)) {
                foreach ($room['secondary_room_images_to_remove'] as $roomImageID) {
                    $roomImage = SecondaryRoomImage::find($roomImageID);
                    ControllerServices::deleteImage('secondary_room_image', $roomImage);
                    $roomImage->delete();
                }
                unset($room['secondary_room_images_to_remove']);
            }

            foreach ($room['secondary_room_images'] as $image) {
                if ($image['id']) {
                    $existingImage = SecondaryRoomImage::find($image['id']);
                } else {
                    $existingImage = new SecondaryRoomImage;
                    $existingImage->room_id = $existingRoom->id;
                }

                if(!is_string($image['secondary_room_image'])) {
                    $filepath = Storage::disk("public")->putFile($imagePath, $image['secondary_room_image']);
                    $image['secondary_room_image'] = $filepath;

                    unset($image['id']);
                    unset($image['property_id']);

                    $existingImage->fill($image);
                    $existingImage->save();
                }
            }
            unset($room['secondary_room_images']);

            unset($room['remove_room_image_primary']);
            unset($room['id']);
            unset($room['property_id']);

            $existingRoom->fill($room);
            $existingRoom->save();
        }
        unset($data['rooms']);

        $roomsPage->fill($data);
        $roomsPage->save();

        return Redirect::route('edit.rooms');
    }

    public static function getRoomsPageData(int $userID, bool $getURL = true): array
    {
        $roomsPage = User::find($userID)->property->roomsPage;
        $data = $roomsPage->toArray();

        $rooms = [];
        foreach ($roomsPage->rooms as $room) {
            $roomData = $room->toArray();
            $roomData['room_image_primary'] = ControllerServices::getImageIfExists($roomData['room_image_primary'], $getURL);

            $secondaryRoomImages = [];
            foreach ($room->secondaryRoomImages as $secondaryRoomImage) {
                $roomImageData = $secondaryRoomImage->toArray();
                $roomImageData['secondary_room_image'] = ControllerServices::getImageIfExists($roomImageData['secondary_room_image'], $getURL);
                $secondaryRoomImages[] = $roomImageData;
            }
            $roomData['secondary_room_images'] = $secondaryRoomImages;

            $rooms[] = $roomData;
        }
        $data['rooms'] = $rooms;

        $data['rooms_page_section_image'] = ControllerServices::getImageIfExists($data['rooms_page_section_image'], $getURL);

        return $data;
    }
}
