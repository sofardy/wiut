<?php

namespace Database\Factories;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->words(3, true);

        return [
            'product_id' => $this->faker->numberBetween(1, 10),
            'shop_id' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->numberBetween(1_000_000, 10_000_000),
            'updated_at_price' => $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'shop_product_url' => $this->faker->url(),
        ];
    }
}
