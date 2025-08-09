<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->regexify('(\+201|01)[0-2,5]{1}[0-9]{8}'), // Egyptian mobile number
            'password' => bcrypt('password123'),
        ];
    }
}
