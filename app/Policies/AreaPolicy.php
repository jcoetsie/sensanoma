<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Area;
use Illuminate\Auth\Access\HandlesAuthorization;

class AreaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the area.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Area  $area
     * @return mixed
     */
    public function view(User $user, Area $area)
    {
        return $user->account_id == $area->account_id;
    }

    /**
     * Determine whether the user can create areas.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user, Area $area)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the area.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Area  $area
     * @return mixed
     */
    public function update(User $user, Area $area)
    {
        return $user->account_id == $area->account_id;
    }

    /**
     * Determine whether the user can delete the area.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Area  $area
     * @return mixed
     */
    public function delete(User $user, Area $area)
    {
        return $user->account_id == $area->account_id;
    }
}
