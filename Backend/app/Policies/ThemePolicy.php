<?php

namespace App\Policies;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThemePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Theme $theme)
    {
        return $user->id === $theme->user_id;
    }

    public function update(User $user, Theme $theme)
    {
        return $user->id === $theme->user_id;
    }

    public function delete(User $user, Theme $theme)
    {
        return $user->id === $theme->user_id;
    }
}
