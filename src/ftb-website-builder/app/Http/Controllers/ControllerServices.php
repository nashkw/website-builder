<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ControllerServices
{
    public static function getImageIfExists (?string $path): ?string
    {
        if($path && Storage::disk('public')->exists($path)) {
            return Storage::url($path);
        }
        return null;
    }

    public static function deleteImage (string $field, Model $currentData): void
    {
        if ($currentData[$field]) {
            Storage::disk("public")->delete($currentData[$field]);
        }
    }

    public static function uploadImage (
        Request $request,
        string $field,
        ?string $shouldDelete,
        string $path,
        Model $currentData,
        array $data
    ): array
    {
        if($shouldDelete) {
            if ($request[$shouldDelete] || $request[$field]) {
                self::deleteImage($field, $currentData);
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

    public static function getRoutes(String $prefix, array $params = []): array
    {
        return [
            'home' => route($prefix, $params),
            'rooms' => route($prefix . '.rooms', $params),
            'reviews' => route($prefix . '.reviews', $params),
            'about' => route($prefix . '.about', $params),
            'explore' => route($prefix . '.explore', $params),
            'findus' => route($prefix . '.findus', $params),
            'faq' => route($prefix . '.faq', $params),
        ];
    }
}
