<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\ReviewsPage\ReviewsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewsPageController extends Controller
{


    private function getImageIfExists (?string $path): ?string
    {
        if($path && Storage::disk('public')->exists($path)) {
            return Storage::url($path);
        }
        return null;
    }

    private function deleteImage (string $field, ReviewsPage $currentData) : void
    {
        if ($currentData[$field]) {
            Storage::disk("public")->delete($currentData[$field]);
        }
    }

    private function uploadImage (
        Request $request,
        string $field,
        ?string $shouldDelete,
        string $path,
        ReviewsPage $currentData,
        array $data
    ): array
    {
        if($shouldDelete) {
            if ($request[$shouldDelete] || $request[$field]) {
                $this->deleteImage($field, $currentData);
                $data[$field] = null;
            }
            unset($data[$shouldDelete]);
        }
        if ($request[$field]) {
            $filepath = Storage::disk("public")->putFile($path, $request[$field]);
            $data[$field] = $filepath;
        }
        else {
            unset($data[$field]);
        }
        return $data;
    }
}
