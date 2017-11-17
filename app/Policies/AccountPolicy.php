<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account  $model
     * @return mixed
     */
    public function view(User $user, Account $account)
    {
        return $user->account_id == $account->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account  $model
     * @return mixed
     */
    public function update(User $user, Account $account)
    {
        return $user->account_id == $account->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account  $model
     * @return mixed
     */
    public function delete(User $user, Account $account)
    {
        return $user->account_id == $account->id;
    }
}
