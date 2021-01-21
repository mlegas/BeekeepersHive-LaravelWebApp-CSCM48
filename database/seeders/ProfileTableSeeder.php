<?php

namespace Database\Seeders;

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
        $profile->user_id = 1;
        $profile->save();

        # Profile Factory can be found in the Profile Page factory.
    }
}
