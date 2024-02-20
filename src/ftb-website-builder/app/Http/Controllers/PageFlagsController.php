<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PageFlagsController
{
    /**
     * Display the page addition hub page.
     */
    public function add(Request $request): Response
    {
        return Inertia::render(
            'AddContent/Add',
            ['page_flags' => $this->getPageFlagsData($request->user()->id)]
        );
    }
    /**
     * Display the website editing hub page.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render(
            'EditContent/Edit',
            ['page_flags' => $this->getPageFlagsData($request->user()->id)]
        );
    }

    public static function getPageFlagsData(int $userID): array
    {
        $data = User::find($userID)->property->pageFlags->toArray();
        return $data;
    }
}
