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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'avatar' => ['nullable', 'image'],
            'biography' => ['nullable', 'string', 'max:600'],
            'location' => ['nullable', 'string', 'max:36'],
            'name_displayed' => ['nullable', 'string', 'max:36', 'unique:profiles'],
        ]);

        $profile = new Profile;
        $profile->location = $request->location;

        $user = Auth::user();
        $user->successfully_registered = TRUE;
        $user->save();

        if ($request->hasFile('avatar'))
        {
            $path = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar = $path;
        }

        else
        {
            $profile->avatar = 'avatars/defaultAvatar.jpg';
        }

        if ($request->has('biography') && $request->input('biography')->isNotEmpty())
        {
            $profile->biography = $request->biography;
        }

        else
        {
            $profile->location = '...';
        }

        if ($request->has('location') && $request->input('location')->isNotEmpty())
        {
            $profile->location = $request->location;
        }

        else
        {
            $profile->location = '...';
        }

        if ($request->has('name_displayed') && $request->input('name_displayed')->isNotEmpty())
        {
            $profile->name_displayed = $request->name_displayed;
        }

        else
        {
            $profile->name_displayed = $user->name;
        }

        $profile->user_id = $user->id;
        $profile->save();

        $profile_page = new ProfilePage;
        $profile_page->biography = $profile->biography;
        $profile_page->views = '0';
        $profile_page->profile_id = $profile->id;
        $profile_page->save();

        return redirect()->action([HomeController::class, 'index'])->with('status', 'User successfully registered!');
    }

    public function index()
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
}
