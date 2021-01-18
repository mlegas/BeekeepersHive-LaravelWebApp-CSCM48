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
        ProfilePage::factory()->count(20)->create();
    }
}
