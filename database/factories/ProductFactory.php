<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Helpers\ImageHelper;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'slug' => Str::slug($this->faker->words(3, true)),
            'description' => $this->faker->paragraph(),
            'image' => ImageHelper::generateAndStoreImage('product'),
            'category_id' => \App\Models\Category::factory(), // если ты хочешь создавать вместе с категорией
        ];
    }
}
