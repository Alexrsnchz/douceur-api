<?php

namespace Database\Factories\Products;

use App\Models\Products\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products\Product>
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
        fake() -> addProvider(new \Mmo\Faker\PicsumProvider(fake()));

        return [
            'prodName' => fake() -> unique() -> words(random_int(1, 2), true),
            'description' => fake() -> text(300),
            'price' => fake() -> randomFloat(2, 10, 30),
            'availability' => fake() -> randomElement(['Disponible', 'Agotado']),
            'prodImg' => 'products/'.fake() -> picsum('public/storage/products', 640, 480, false),
            'category_id' => Category::all() -> random() -> id
        ];
    }
}
