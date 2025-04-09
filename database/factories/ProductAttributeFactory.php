<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductAttribute>
 */
class ProductAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->locale('ru_RU'); // Устанавливаем локаль Faker на русский

        return [
            'name' => ucfirst($this->faker->unique()->words(2, true)), // Генерация уникальных русских слов
        ];
    }
}
