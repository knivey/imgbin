<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Image;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;

    public function destroy(User $user, Image $image) {
        //somehow image->user_id was a string so no type strict here
        if($user->id == $image->user_id) {
            return $this->allow();
        }
        return $this->deny("You do not own this image.");
    }

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
