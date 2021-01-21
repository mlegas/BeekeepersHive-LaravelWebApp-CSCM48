<?php

namespace App\Http\Controllers;

use App\Models\ProfilePage;
use Illuminate\Http\Request;

class ProfilePageController extends Controller
{
    public function show(ProfilePage $profilePage)
    {
        return view('profilepages.show', [
            'profilePage' => $profilePage
        ]);
    }
}
