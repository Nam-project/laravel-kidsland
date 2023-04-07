<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'size' => $this->faker->text(20),
            'suitable_age' => $this->faker->text(20),
            'user_manual' => $this->faker->text(300),
            'preserve' => $this->faker->text(300),
        ];
    }
}
