<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment = new Comment;
        $comment->content = "Also, I just made a comment!";
        $comment->post_id = 1;
        $comment->user_id = 1;
        $comment->save();

        Comment::factory()->count(25)->create();
    }
}
