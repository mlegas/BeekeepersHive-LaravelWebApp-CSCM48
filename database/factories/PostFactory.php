<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'topic' => $this->faker->text(30),
            'content' => $this->faker->text(200),
            // Sets the user_id to a random already existing Profile.
            'profile_id' => \App\Models\Profile::inRandomOrder()->first()->id,
        ];
    }
}
