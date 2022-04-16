<?php

namespace App\Policies;

use App\Models\Major;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MajorPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Major $major)
    {
        return $user->isSuperadminOrAdmin();
    }

    public function delete(User $user, Major $major)
    {
        return $user->isSuperadminOrAdmin();
    }
}
