<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str ;

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
        $name=fake()->text(25);
        return [
            'code'=> Str::random(9),
            'name'=> $name,
            'slug'=>Str::slug($name).'-'. Str::random(8),
            'image'=>'https://canifa.com/ao-phong-nam-8ts22s072',
            'price'=> rand(10,100),
            'sale_price'=> null,
            'description'=> fake()->paragraph(3),
            'material'=> fake()->text(50),
            'category_id'=>rand(1,3),
            'brand_id'=>rand(1,3),
            'created_at'=>now(),

        ];
    }
}
