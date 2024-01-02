<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerServices;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\WebsiteController;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class RoomsPageController extends Controller
{
    /**
     * Display a preview of the generated site rooms page.
     */
    public function preview(Request $request): Response
    {
        return Inertia::render(
            'GeneratedSite/RoomsPreview',
            [
                'rooms_page' => $this->getRoomsPageData($request->user()->id),
                'property' => PropertyController::getPropertyData($request->user()->id),
                'website' => WebsiteController::getWebsiteData($request->user()->id),
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
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'rooms_page_section_header' => ['required', 'string', 'max:255'],
            'rooms_page_section_paragraph' => ['nullable', 'string', 'max:65535'],
            'rooms_page_section_image' => ['nullable', 'image'],
            'remove_rooms_page_section_image' => ['required', 'boolean'],
        ]);

        $roomsPage = User::find($request->user()->id)->property->roomsPage;
        $data = $request->all();

        $data = ControllerServices::uploadImage(
            $request,
            'rooms_page_section_image',
            'remove_rooms_page_section_image',
            'images/sectionImages/roomsPrimary/',
            $roomsPage,
            $data
        );

        $roomsPage->fill($data);
        $roomsPage->save();

        return Redirect::route('edit.rooms');
    }

    private function getRoomsPageData(int $userID): array
    {
        $roomsPage = User::find($userID)->property->roomsPage;
        $data = $roomsPage->toArray();

        $rooms = [];
        foreach ($roomsPage->rooms as $room) {
            $roomData = $room->toArray();
            $roomData['room_image_primary'] = ControllerServices::getImageIfExists($roomData['room_image_primary']);

            $secondaryRoomImages = [];
            foreach ($room->secondaryRoomImages as $secondaryRoomImage) {
                $roomImageData = $secondaryRoomImage->toArray();
                $roomImageData['secondary_room_image'] = ControllerServices::getImageIfExists($roomImageData['secondary_room_image']);
                $secondaryRoomImages[] = $roomImageData;
            }
            $roomData['secondary_room_images'] = $secondaryRoomImages;

            $rooms[] = $roomData;
        }
        $data['rooms'] = $rooms;

        $data['rooms_page_section_image'] = ControllerServices::getImageIfExists($data['rooms_page_section_image']);

        return $data;
    }
}
