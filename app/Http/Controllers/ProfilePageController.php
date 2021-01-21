<?php

namespace App\Http\Controllers;

use App\Models\ProfilePage;
use Illuminate\Http\Request;

class ProfilePageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'profile.completed', 'verified']);
    }

    public function show(ProfilePage $profile_page)
    {
        return view('profilepages.show', [
            'profile_page' => $profile_page
        ]);
    }
}
