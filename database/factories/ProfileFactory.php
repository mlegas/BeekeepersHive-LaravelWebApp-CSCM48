<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'avatar' => 'avatars/defaultAvatar.jpg',
            'name_displayed' => $this->faker->name(),
            'location' => $this->faker->city(),
            'user_id' => \App\Models\User::factory()->create()->id,
        ];
    }
}
