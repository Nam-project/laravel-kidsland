<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product_name = $this->faker->unique()->words($nb=4,$asText=true);
        $slug = Str::slug($product_name);
        return [
            'name' => $product_name,
            'slug' => $slug,
            'description' => $this->faker->text(500),
            'regular_price' => $this->faker->numberBetween(10, 500),
            'sale_price' => $this->faker->numberBetween(10, 500),
            'SKU' => 'DIGI'.$this->faker->unique()->numberBetween(100, 500),
            'stock_status' => 'instock',
            'featured'=> false,
            'quantity' => $this->faker->numberBetween(10,20),
            'image' => 'diaper_'.$this->faker->unique()->numberBetWeen(1,6).'.png',
            'subcategory_id' => $this->faker->numberBetween(1,5),
            'brand_id' => $this->faker->numberBetween(1,5)
        ];
    }
}
