<?php

namespace App\Policies;

use App\User;
use App\Role;

class RolePolicy
{
    /**
     * Determine if user can make create category request.
     *
     * @param  App\User  $user
     * @param  App\Role  $role
     * @return bool
     */
    public function createCategory(User $user, Role $role)
    {
        return $role->name == "Admin";
    }

    /**
     * Determine if user can make update category request.
     *
     * @param  App\User  $user
     * @param  App\Role  $role
     * @return bool
     */
    public function updateCategory(User $user, Role $role)
    {
        return $role->name == "Admin";
    }

    /**
     * Determine if user can make create type request.
     *
     * @param  App\User  $user
     * @param  App\Role  $role
     * @return bool
     */
    public function createType(User $user, Role $role)
    {
        return $role->name == "Admin";
    }

    /**
     * Determine if user can make update type request.
     *
     * @param  App\User  $user
     * @param  App\Role  $role
     * @return bool
     */
    public function updateType(User $user, Role $role)
    {
        return $role->name == "Admin";
    }


    /**
     * Determine if user can make create saving_temp request.
     *
     * @param  App\User  $user
     * @param  App\Role  $role
     * @return bool
     */
    public function createSavingTemp(User $user, Role $role)
    {
        return $role->name == "Admin";
    }

    /**
     * Determine if user can make update saving_temp request.
     *
     * @param  App\User  $user
     * @param  App\Role  $role
     * @return bool
     */
    public function updateSavingTemp(User $user, Role $role)
    {
        return $role->name == "Admin";
    }

    /**
     * Determine if user can make create credit request.
     *
     * @param  App\User  $user
     * @param  App\Role  $role
     * @return bool
     */
    public function createCredit(User $user, Role $role)
    {
        return $role->name == "Admin";
    }

    /**
     * Determine if user can make update credit request.
     *
     * @param  App\User  $user
     * @param  App\Role  $role
     * @return bool
     */
    public function updateCredit(User $user, Role $role)
    {
        return $role->name == "Admin";
    }

    /**
     * Determine if user can make sync all user request.
     *
     * @param  App\User  $user
     * @param  App\Role  $role
     * @return bool
     */
    public function syncAllUser(User $user, Role $role)
    {
        return $role->name == "Admin";
    }

    /**
     * Determine if user can make sync specific user request.
     *
     * @param  App\User  $user
     * @param  App\Role  $role
     * @return bool
     */
    public function syncSpecificUser(User $user, Role $role)
    {
        return $role->name == "Admin";
    }

    /**
     * Determine if user can make unsync all user request.
     *
     * @param  App\User  $user
     * @param  App\Role  $role
     * @return bool
     */
    public function unsyncAllUser(User $user, Role $role)
    {
        return $role->name == "Admin";
    }

    /**
     * Determine if user can make sync specific user request.
     *
     * @param  App\User  $user
     * @param  App\Role  $role
     * @return bool
     */
    public function unsyncSpecificUser(User $user, Role $role)
    {
        return $role->name == "Admin";
    }

}
