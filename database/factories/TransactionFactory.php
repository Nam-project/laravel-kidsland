<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 7,
            'order_id' => 18,
            'mode' => 'cod',
            'status' => 'pending'
        ];
    }
}
