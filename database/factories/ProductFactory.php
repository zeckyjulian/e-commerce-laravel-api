<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        $numbers = range(1, 10);
        shuffle($numbers);
        $number = array_shift($numbers);
        return [
            'product_name' => fake()->sentence(mt_rand(3, 6)),
            'color' => fake()->safeColorName(),
            'category_id' => mt_rand(1, 3),
            'price' => fake()->randomFloat(2, 10, 100),
            'description' => fake()->paragraph(mt_rand(3, 6)),
            'image' => 'product-'.$number.'.jpg',
        ];
    }
}
