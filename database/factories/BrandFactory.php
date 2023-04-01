<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $brand_name = $this->faker->unique()->words($nb=2,$asText=true);
        return [
            'name' => $brand_name,
            'origin' => $this->faker->text(20)
        ];
    }
}
