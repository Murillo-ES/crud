<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'name' => Str::ucfirst($this->faker->unique()->words(2, true)),
            'description' => Str::ucfirst($this->faker->paragraph()),
            'price' => $this->faker->randomFloat(1, 999, 2),
            'stock' => $this->faker->randomNumber(3, false),
        ];
    }
}
