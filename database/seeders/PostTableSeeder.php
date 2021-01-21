<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post;
        $post->topic = 'Seeding in Laravel';
        $post->content = 'Seeding is a wonderful technique. I hope to do it more often!';
        $post->profile_id = 1;
        $post->save();

        Post::factory()->count(20)->create();

        $posts = Post::get();

        foreach ($posts as $post)
        {
                // The loop attaches a random already existing Tag to each Post.
                $post->tags()->attach(\App\Models\Tag::inRandomOrder()->first()->id);
        }
    }
}
