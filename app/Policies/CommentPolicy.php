<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Comment $comment)
    {
        if ($user->id === $comment->profile->user_id)
        {
            return TRUE;
        }

        else
        {
            return FALSE;
        }
    }

    public function delete(User $user, Comment $comment)
    {
        if ($user->id === $comment->profile->user_id || $user->is_admin)
        {
            return TRUE;
        }

        else
        {
            return FALSE;
        }
    }
}
