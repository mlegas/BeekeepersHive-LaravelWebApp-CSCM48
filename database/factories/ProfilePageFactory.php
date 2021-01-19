<?php

namespace Database\Factories;

use App\Models\ProfilePage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfilePageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProfilePage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'biography' => $this->faker->text(50),
            'views' => $this->faker->numberBetween(0, 100),
            'profile_id' => \App\Models\Profile::factory()->create()->id,
        ];
    }
}
