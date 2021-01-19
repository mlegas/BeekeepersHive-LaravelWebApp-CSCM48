<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfilePage;

class ProfilePageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile_page = new ProfilePage;
        $profile_page->biography = 'I love beekeeping!';
        $profile_page->views = '42';
        $profile_page->profile_id = 1;
        $profile_page->save();

        ProfilePage::factory()->count(20)->create();
    }
}
