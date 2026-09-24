<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Post::factory(50)->create();

        $tags = ['라라벨', 'PHP', 'JavaScript', '데이터베이스', '웹개발'];
        foreach ($tags as $tagName) {
            Tag::firstOrCreate(['name' => $tagName]);
        }
    }
}
