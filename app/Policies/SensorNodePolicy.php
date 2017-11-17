<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SensorNode;
use Illuminate\Auth\Access\HandlesAuthorization;

class SensorNodePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the sensorNode.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SensorNode  $sensorNode
     * @return mixed
     */
    public function view(User $user, SensorNode $sensorNode)
    {
        return $user->account_id == $sensorNode->account_id;
    }

    /**
     * Determine whether the user can create sensorNodes.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the sensorNode.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SensorNode  $sensorNode
     * @return mixed
     */
    public function update(User $user, SensorNode $sensorNode)
    {
        return $user->account_id == $sensorNode->account_id;
    }

    /**
     * Determine whether the user can delete the sensorNode.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SensorNode  $sensorNode
     * @return mixed
     */
    public function delete(User $user, SensorNode $sensorNode)
    {
        return $user->account_id == $sensorNode->account_id;
    }
}
