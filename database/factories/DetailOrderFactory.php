<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DetailOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'count' => $this->faker->numberBetween(1,3),
            'price' => $this->faker->numberBetween(100000,500000),
            'product_id' => $this->faker->numberBetween(7,29)
        ];
    }
}
