<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Users\Address;
use App\Models\Users\Post;
use App\Models\Users\User;
use Database\Seeders\Products\AllergenSeeder;
use Database\Seeders\Products\CategorySeeder;
use Database\Seeders\Products\ProductSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crea el usuario por defecto que usará el propietario
        // de la tienda.
        User::create([
            'username' => 'Douceur',
            'email' => 'douceur@gmail.com',
            'password' => 'password',
            'isAdmin' => true,
            'address' => null,
        ]);

        // Llama al factory de User.
        User::factory(14) -> create();

        // Elimina y vuelve a crear el directorio posts.
        Storage::deleteDirectory('posts');
        Storage::createDirectory('posts');

        // Llama al factory de Post.
        Post::factory(40) -> create();

        // Elimina y vuelve a crear el directorio products.
        Storage::deleteDirectory('products');
        Storage::createDirectory('products');

        // Llama a los seeders.
        $this -> call([
            AllergenSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
