<?php

namespace App\Http\Controllers\Auth;

use App\Models\Profile;
use App\Models\ProfilePage;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterStep2Controller extends Controller
{
    public function postForm(Request $request)
    {
        $profile = new Profile;
        $profile->name_displayed = $request->name_displayed;
        $profile->location = $request->location;

        $user = Auth::user();
        $user->successfully_registered = TRUE;
        $user->save();

        $profile->user_id = $user->id;

        if ($request->hasFile('avatar'))
        {
            $avatar = $request->file('avatar');
            $path = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar = $path;
        }

        else
        {
            $profile->avatar = 'defaultAvatar.jpg';
        }

        $profile->save();

        $profile_page = new ProfilePage;
        $profile_page->biography = $request->biography;
        $profile_page->views = '0';
        $profile_page->profile_id = $profile->id;
        $profile_page->save();

        return redirect()->action([HomeController::class, 'index']);
    }

    public function showForm()
    {
        if (!Auth::user()->successfully_registered)
        {
            return view('auth.register_step2');
        }

        else
        {
            return redirect()->action([HomeController::class, 'index']);
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'avatar' => ['nullable', 'image'],
            'biography' => ['nullable', 'string', 'max:3000'],
            'location' => ['nullable', 'string', 'max:255'],
            'name_displayed' => ['required', 'string', 'max:255', 'unique:users'],
        ]);
    }
}
