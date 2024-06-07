<?php

namespace Database\Factories\Users;

use App\Models\Users\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake() -> unique() -> userName(),
            'email' => fake() -> unique() -> email(),
            'password' => 'password',
            'isAdmin' => false,
            'address' => fake() -> randomElement([fake() -> address(), null]),
        ];
    }
}
