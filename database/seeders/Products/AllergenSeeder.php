<?php

namespace Database\Seeders\Products;

use App\Models\Products\Allergen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllergenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allergens = [
            ['alrgnName' => 'Gluten', 'alrgnColor' => '#C8945E', 'alrgnIcon' => 'allergens/gluten.png'],
            ['alrgnName' => 'Crustáceos', 'alrgnColor' => '#A05442', 'alrgnIcon' => 'allergens/crustaceos.png'],
            ['alrgnName' => 'Huevos', 'alrgnColor' => '#C4A99B', 'alrgnIcon' => 'allergens/huevos.png'],
            ['alrgnName' => 'Pescado', 'alrgnColor' => '#4171B5', 'alrgnIcon' => 'allergens/pescado.png'],
            ['alrgnName' => 'Cacahuetes', 'alrgnColor' => '#BCA270', 'alrgnIcon' => 'allergens/cacahuetes.png'],
            ['alrgnName' => 'Soja', 'alrgnColor' => '#417344', 'alrgnIcon' => 'allergens/soja.png'],
            ['alrgnName' => 'Lácteos', 'alrgnColor' => '#87A9D6', 'alrgnIcon' => 'allergens/lacteos.png'],
            ['alrgnName' => 'Frutos con cáscara', 'alrgnColor' => '#8F6760', 'alrgnIcon' => 'allergens/frutos-con-cascara.png'],
            ['alrgnName' => 'Apio', 'alrgnColor' => '#E2D47F', 'alrgnIcon' => 'allergens/apio.png'],
            ['alrgnName' => 'Mostaza', 'alrgnColor' => '#BACB58', 'alrgnIcon' => 'allergens/mostaza.png'],
            ['alrgnName' => 'Sésamo', 'alrgnColor' => '#4F4E4E', 'alrgnIcon' => 'allergens/sesamo.png'],
            ['alrgnName' => 'Sulfitos', 'alrgnColor' => '#3C4356', 'alrgnIcon' => 'allergens/sulfitos.png'],
            ['alrgnName' => 'Altramuces', 'alrgnColor' => '#B05540', 'alrgnIcon' => 'allergens/altramuces.png'],
            ['alrgnName' => 'Moluscos', 'alrgnColor' => '#A3C096', 'alrgnIcon' => 'allergens/moluscos.png'],
        ];

        foreach ($allergens as $allergen) {
            Allergen::create([
                'alrgnName' => $allergen['alrgnName'],
                'alrgnColor' => $allergen['alrgnColor'],
                'alrgnIcon' => $allergen['alrgnIcon']
            ]);
        }
    }
}
