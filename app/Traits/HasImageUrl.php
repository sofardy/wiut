<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HasImageUrl
{
    /**
     * Get the URL for the image attribute.
     *
     * @return string|null
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        return asset('storage/' . $this->image);
    }
}
