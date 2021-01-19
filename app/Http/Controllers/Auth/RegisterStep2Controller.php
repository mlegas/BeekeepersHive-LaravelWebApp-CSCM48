<?php

namespace App\Http\Controllers\Auth;

use App\Models\Profile;
use App\Models\ProfilePage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterStep2Controller extends Controller
{
    public function postForm(Request $request)
    {
        // CHANGE THIS
        $profile = new Profile;
        $profile->name_displayed = $request->name_displayed;
        $profile->location = $request->location;
        $profile->user_id = Auth::id();
        $profile->save();

        $profile_page = new ProfilePage;
        $profile_page->biography = $request->biography;
        $profile_page->views = '0';
        $profile_page->profile_id = $profile->id;
        $profile_page->save();

        return redirect()->route('home');
    }

    public function showForm()
    {
        return view('auth.register_step2');
    }

    protected function validator(array $data)
    {
        // CHANGE THIS
        return Validator::make($data, [
            'name_displayed' => ['required', 'string', 'max:255', 'unique:users'],
            'bio' => ['nullable', 'string', 'max:3000'],
        ]);
    }
}
