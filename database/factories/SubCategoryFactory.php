<?php

namespace Database\Factories;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $subcategory_name = $this->faker->unique()->words($nb=2,$asText=true);
        $slug = Str::slug($subcategory_name);
        return [
            'name' => $subcategory_name,
            'slug' => $slug
        ];
    }
}
