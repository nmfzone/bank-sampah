<?php

namespace App\Awesome\Contracts\Controllers\Dashboard\Admin;

use Illuminate\Http\Request;

use App\User;
use App\Role;

use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;

interface UserManagementContract
{
    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index();

    /**
     * Get all users by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers();

    /**
     * Get users by ajax request based on username and/or name.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function autocomplete(Request $request, User $user);

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create();

    /**
     * Store a newly created user in storage.
     *
     * @param  App\Http\Requests\Users\CreateUserRequest  $request
     * @param  App\User  $user
     * @param  App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request, User $user, Role $role);

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
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, $setting = false, $pageTitle = "Edit User");

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
     * @return \Illuminate\Http\Response
     */
    public function setting();
}
