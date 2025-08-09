<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        Post::factory()->count(20)->create([
            'user_id' => fn () => $users->random()->id,
        ]);
    }
}
