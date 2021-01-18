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
        $profile = new Profile;
        $profile->name_displayed = 'EliteBeekeeper1337';
        $profile->location = 'Warsaw';
        $profile->date_of_birth = Carbon::create(1605, 11, 05);
        $profile->user_id = 1;
        $profile->save();

        # Factory in Profile Page factory.
    }
}
