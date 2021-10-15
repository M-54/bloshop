<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsDemoSeeder::class);

        \App\Models\User::factory(5)
            ->has(Post::factory()->count(6))
            ->create();

        \App\Models\User::factory(2)->create();

        Comment::factory(10)->create();
    }
}
