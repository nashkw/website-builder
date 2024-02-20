<?php

namespace App\Http\Controllers;

use App\Models\User;

class PageFlagsController
{
    public static function getPageFlagsData(int $userID): array
    {
        $data = User::find($userID)->property->pageFlags->toArray();
        return $data;
    }
}
