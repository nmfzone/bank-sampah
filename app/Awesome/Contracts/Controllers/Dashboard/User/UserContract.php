<?php

namespace App\Awesome\Contracts\Controllers\User;

use App\User;
use App\Category;
use App\Type;
use App\Saving;

use App\Http\Requests\Users\UpdateUserRequest;

interface UserContract
{
    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category);

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create();

    /**
     * Store a newly created user in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store();

    /**
     * Display the specified user.
     *
     * @return \Illuminate\Http\Response
     */
    public function show();

    /**
     * Show the form for editing the specified user.
     *
     * @param  string  $user
     * @param  bool  $setting
     * @param  string  $pageTitle
     * @return \Illuminate\Http\Response
     */
    public function edit($user, $setting = false, $pageTitle);

    /**
     * Update the specified user in storage.
     *
     * @param  int  $id
     * @param  App\Http\Requests\Users\UpdateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateUserRequest $request);

    /**
     * Remove the specified user from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy();

    /**
     * Show the form for editing the current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function setting();
}
