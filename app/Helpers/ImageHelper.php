<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ImageHelper
{
    public static function generateAndStoreImage(string $folder, string $size = '640/480'): string
    {
        $filename = Str::uuid() . '.jpg';
        $path = $folder . '/' . $filename;
        $url = 'https://picsum.photos/' . $size;

        $image = Http::get($url);

        if ($image->successful()) {
            Storage::disk('public')->put($path, $image->body());
        }

        return $path;
    }
}
