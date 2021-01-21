<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Post $post)
    {
        if ($user->id === $post->profile->user_id)
        {
            return TRUE;
        }

        else
        {
            return FALSE;
        }
    }

    public function delete(User $user, Post $post)
    {
        if ($user->id === $post->profile->user_id || $user->is_admin)
        {
            return TRUE;
        }

        else
        {
            return FALSE;
        }
    }
}
