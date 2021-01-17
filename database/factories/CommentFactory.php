<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->text(100),
            // Sets the post_id to a random already existing Post.
            'post_id' => \App\Models\Post::inRandomOrder()->first()->id,
            // Sets the user_id to a random already existing User.
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}
