<?php

namespace Database\Seeders\Products;

use App\Models\Products\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['catName' => 'Tartas y pasteles', 'catColor' => '#FF99B4', 'catIcon' => 'categories/cake_icon.png'],
            ['catName' => 'Galletas y brownies', 'catColor' => '#A2FF4D', 'catIcon' => 'categories/cookie_icon.png'],
            ['catName' => 'Cupcakes y muffins', 'catColor' => ' #5FC8D1', 'catIcon' => 'categories/cupcake_icon.png'],
            ['catName' => 'Panadería artesanal', 'catColor' => '#FFA07A', 'catIcon' => 'categories/bakery_icon.png'],
            ['catName' => 'Postres individuales', 'catColor' => '#8DA6FF', 'catIcon' => 'categories/dessert_icon.png'],
            ['catName' => 'Postres sin gluten', 'catColor' => '#FFBF80', 'catIcon' => 'categories/gluten_icon.png'],
            ['catName' => 'Postres veganos', 'catColor' => '#FFA54C', 'catIcon' => 'categories/vegan_icon.png'],
            ['catName' => 'Pasteles temáticos', 'catColor' => '#CC99FF', 'catIcon' => 'categories/wedding_icon.png'],
            ['catName' => 'Bebidas caseras', 'catColor' => ' #FF6347', 'catIcon' => 'categories/drink_icon.png'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'catName' => $category['catName'],
                'catColor' => $category['catColor'],
                'catIcon' => $category['catIcon']
            ]);
        }
    }
}
