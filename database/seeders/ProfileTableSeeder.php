<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Profile;
        $user->name = 'LaravelMaster';
        $user->location = 'Warsaw';
        $user->date_of_birth = Carbon::create(1605, 11, 05);
        $user->save();

        Profile::factory()->count(5)->create();
    }
}
