<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->text(2000),
            'contact_phone' => $this->faker->regexify('(\+201|01)[0-2,5]{1}[0-9]{8}'),
            'user_id' => User::factory(),
        ];
    }
}
