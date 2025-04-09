<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\ProductAttribute;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductAttributeValue>
 */
class ProductAttributeValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 10),
            'product_attribute_id' => $this->faker->numberBetween(1, 10),
            'value' => $this->faker->word(),
        ];
    }
}
