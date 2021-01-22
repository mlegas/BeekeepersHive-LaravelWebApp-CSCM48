<?php

namespace App\Http\Controllers;

use App\Models\ProfilePage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfilePageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'profile.completed', 'verified']);
    }

    public function edit(ProfilePage $profile_page)
    {
        $this->authorize('edit', $profile_page);

        return view('profilepages.edit', [
            'profile_page' => $profile_page
        ]);
    }

    public function show(ProfilePage $profile_page)
    {
        views($profile_page)->cooldown(10)->record();

        return view('profilepages.show', [
            'profile_page' => $profile_page
        ]);
    }

    public function update(Request $request, ProfilePage $profile_page)
    {
        $this->validate($request, [
            'avatar' => ['nullable', 'image'],
            'biography' => ['nullable', 'string', 'max:600'],
            'location' => ['nullable', 'string', 'max:36'],
            'name_displayed' => ['nullable', 'string', 'max:36', 'unique:profiles'],
        ]);

        $profile = $profile_page->profile;

        if ($request->hasFile('avatar'))
        {
            $path = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar = $path;
        }

        if ($request->has('location') && !empty($request->input('location')))
        {
            $profile->location = $request->location;
        }

        if ($request->has('name_displayed') && !empty($request->input('name_displayed')))
        {
            $profile->name_displayed = $request->name_displayed;
        }

        $profile->save();

        if ($request->has('biography') && !empty($request->input('biography')))
        {
            $profile_page->biography = $request->biography;
        }

        $profile_page->profile->user_id = Auth::user()->id;
        $this->authorize('edit', $profile_page);
        $profile_page->save();

        return redirect()->action([ProfilePageController::class, 'show'], ['profile_page' => $profile_page])->with('status', 'Profile page successfully edited!');
    }
}
