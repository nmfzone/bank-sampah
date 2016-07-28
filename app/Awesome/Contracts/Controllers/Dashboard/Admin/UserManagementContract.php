<?php

namespace App\Awesome\Contracts\Controllers\Admin;

use App\User;
use App\Role;

use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;

interface UserManagementContract
{
    /**
     * Display a listing of the user.
     *
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user);

    /**
     * Show the form for creating a new user.
     *
     * @param  App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function create(Role $role);

    /**
     * Store a newly created user in storage.
     *
     * @param  App\Http\Requests\Users\CreateUserRequest  $request
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request, User $user);

    /**
     * Display the specified user.
     *
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user);

    /**
     * Show the form for editing the specified user.
     *
     * @param  App\User  $user
     * @param  App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Role $role, $setting = false, $pageTitle = "Edit User");

    /**
     * Update the specified user in storage.
     *
     * @param  App\Http\Requests\Users\UpdateUserRequest  $request
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user);

    /**
     * Remove the specified user from storage.
     *
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user);

    /**
     * Show the form for editing the current user.
     *
     * @param  App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function setting(Role $role);
}
