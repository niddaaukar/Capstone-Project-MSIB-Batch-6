<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{
    use HandlesAuthorization;

    public function view(User $user, User $admin)
    {
        return $user->is_admin && $user->id === $admin->id
            ? Response::allow()
            : Response::deny('Anda tidak memiliki izin untuk melihat data admin ini.');
    }

    public function update(User $user, User $admin)
    {
        return $user->is_admin && $user->id === $admin->id
            ? Response::allow()
            : Response::deny('Anda tidak memiliki izin untuk mengubah data admin ini.');
    }
}
