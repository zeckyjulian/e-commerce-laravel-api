<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone' => fake()->phoneNumber(),
            'shipping_address' => fake()->unique()->address(),
            'gender' => fake()->randomElement(['M', 'F']),
            'date_of_birth' => fake()->date('Y_m_d'),
        ];
    }
}
