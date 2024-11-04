<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Blogs;
use Illuminate\Auth\Access\HandlesAuthorization;
class PermissionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function viewAny(User $user)
    {
        return $user->can('view blogs');
    }

}
