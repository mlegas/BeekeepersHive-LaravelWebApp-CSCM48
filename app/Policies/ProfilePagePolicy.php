<?php

namespace App\Policies;

use App\Models\ProfilePage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePagePolicy
{
    use HandlesAuthorization;

    public function edit(User $user, ProfilePage $profile_page)
    {
        if ($user->id === $profile_page->profile->user_id)
        {
            return TRUE;
        }

        else
        {
            return FALSE;
        }
    }
}
