<?php

namespace App\Policies;

use App\Models\Slide;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SlidePolicy
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

    public function update(User $user, Slide $slide)
    {
        return $user->isSuperadminOrAdmin();
    }

    public function delete(User $user, Slide $slide)
    {
        return $user->isSuperadminOrAdmin();
    }
}
