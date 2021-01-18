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
        $commentableType = $this->faker->randomElement([
            \App\Models\Post::class,
            \App\Models\ProfilePage::class,
            ]);

        if ($commentableType === \App\Models\Post::class)
        {
            $commentableId = \App\Models\Post::inRandomOrder()->first()->id;
        }

        else
        {
            $commentableId = \App\Models\ProfilePage::inRandomOrder()->first()->id;
        }

        return [
            'commentable_type' => $commentableType,
            'commentable_id' => $commentableId,
            'content' => $this->faker->text(100),
            // Sets the user_id to a random already existing Profile.
            'profile_id' => \App\Models\Profile::inRandomOrder()->first()->id,
        ];
    }
}
