<?php

namespace App\Policies;

use App\Models\SchoolProfile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolProfilePolicy
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

    public function update(User $user, SchoolProfile $schoolProfile)
    {
        return $user->isSuperadminOrAdmin();
    }
}
