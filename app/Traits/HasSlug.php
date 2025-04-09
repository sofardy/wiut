<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug()
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                // Извлекаем title или name из сырых атрибутов
                $attributes = $model->getAttributes();
                $source = $attributes['title'] ?? $attributes['name'] ?? null;

                // Если source пустое, используем fallback
                $source = $source ?? 'unnamed-' . Str::random(6);

                $model->slug = $model->generateUniqueSlug($source);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title') || $model->isDirty('name')) {
                $attributes = $model->getAttributes();
                $source = $attributes['title'] ?? $attributes['name'] ?? null;

                $source = $source ?? 'unnamed-' . Str::random(6);
                $model->slug = $model->generateUniqueSlug($source);
            }
        });
    }

    protected function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        if (empty($slug)) {
            $slug = 'default-' . Str::random(6);
        }

        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }
}
