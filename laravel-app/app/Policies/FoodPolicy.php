<?php

namespace App\Policies;

use App\Models\Food;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use App\Utilities\Role;

class FoodPolicy
{
    use HandlesAuthorization;


    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->isAdministrator()) {
            return true;
        }
    }



    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Food $food)
    {
        // return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $role = Role::Creator->value;
        $allow = $user->userRoles()->where('role_id', $role)->count() > 0 ? true : false;
        return $allow ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        $role = Role::Editor->value;
        $allow = $user->userRoles()->where('role_id', $role)->count() > 0 ? true : false;
        return $allow ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        $role = Role::Deleter->value;
        $allow = $user->userRoles()->where('role_id', $role)->count() > 0 ? true : false;
        return $allow ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Food $food)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Food $food)
    {
        //
    }
}
