<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total' => $this->faker->numberBetween(300000,1000000),
            'status' => 'delivered',
            'discount' => 0,
            'name' => $this->faker->text(25),
            'user_id' => 7,
            'ward_id' => 21187
        ];
    }
}
