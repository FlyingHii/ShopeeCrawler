<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define default value for seeding product.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->words(5,true),
            'price' => fake()->numberBetween(0, 999999),
            'sold_amount' => fake()->numberBetween(0, 9999),
            'location' => fake()->address(),
            'image' => 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lnnqyge5n14q48',
        ];
    }
}
