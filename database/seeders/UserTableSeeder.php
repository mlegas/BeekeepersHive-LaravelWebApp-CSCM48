<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'LaravelMaster';
        $user->email = 'epicgamer@protonmail.com';
        $user->email_verified_at = now();
        $user->password = 'l33tpr0h4x0rl0l';
        $user->remember_token = Str::random(10);
        $user->save();

        # User Factory can be found in the Profile factory.
    }
}
