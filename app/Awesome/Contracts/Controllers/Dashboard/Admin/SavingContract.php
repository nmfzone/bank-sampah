<?php

namespace App\Awesome\Contracts\Controllers\Dashboard\Admin;

use Illuminate\Http\Request;

use App\Saving;
use App\SavingTemp;
use App\Category;
use App\Type;
use App\User;

use App\Http\Requests\Savings\CreateSavingTempRequest;
use App\Http\Requests\Savings\UpdateSavingTempRequest;
use App\Http\Requests\Savings\CreateCreditRequest;
use App\Http\Requests\Savings\SynchronizeSpecificUserRequest;
use App\Http\Requests\Savings\SynchronizeAllUserRequest;
use App\Http\Requests\Savings\UnsynchronizeSpecificUserRequest;
use App\Http\Requests\Savings\UnsynchronizeAllUserRequest;

interface SavingContract
{
    /**
     * Display a listing of the saving_temp.
     *
     * @return \Illuminate\Http\Response
     */
    public function index();

    /**
     * Display a listing of the savings.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSavings(Request $request, User $user);

    /**
     * Show the form for creating a new saving_temp.
     *
     * @param  App\Category  $category
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category, Type $type);

    /**
     * Store a newly created saving_temp in storage.
     *
     * @param  App\Http\Requests\Savings\CreateSavingTempRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSavingTempRequest $request);

    /**
     * Display the specified saving_temp.
     *
     * @param  int  $id
     * @param  App\SavingTemp  $savingTemp
     * @return \Illuminate\Http\Response
     */
    public function show($id, SavingTemp $savingTemp);

    /**
     * Show the form for editing the specified saving_temp.
     *
     * @param  int  $id
     * @param  App\SavingTemp  $savingTemp
     * @param  App\Category  $category
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit($id, SavingTemp $savingTemp, Category $category, Type $type);

    /**
     * Update the specified saving_temp in storage.
     *
     * @param  App\Http\Requests\Savings\UpdateSavingTempRequest $request
     * @param  int  $id
     * @param  App\SavingTemp  $savingTemp
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSavingTempRequest $request, $id, SavingTemp $savingTemp);

    /**
     * Remove the specified saving from storage.
     *
     * @param  int  $id
     * @param  App\SavingTemp  $savingTemp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, SavingTemp $savingTemp);

    /**
     * Remove the specified saving from storage.
     *
     * @param  int  $id
     * @param  App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function destroySavings($id, Saving $saving);

    /**
     * Show the form for creating a new credit transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function credit();

    /**
     * Store a newly created credit transaction in storage.
     *
     * @param  App\Http\Requests\Savings\CreateCreditRequest $request
     * @param  App\SavingTemp  $savingTemp
     * @param  App\Saving  $saving
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function createCredit(CreateCreditRequest $request, SavingTemp $savingTemp,
        Saving $saving, User $user);

    /**
     * Synchronize transaction for specific user.
     *
     * @param  App\Http\Requests\Savings\SynchronizeSpecificUserRequest $request
     * @param  App\SavingTemp  $savingTemp
     * @return \Illuminate\Http\Response
     */
    public function synchronizeSpecificUser(SynchronizeSpecificUserRequest $request,
        SavingTemp $savingTemp);

    /**
     * Synchronize transaction for all user.
     *
     * @param  App\Http\Requests\Savings\SynchronizeAllUserRequest $request
     * @param  App\User  $user
     * @param  App\SavingTemp  $savingTemp
     * @return \Illuminate\Http\Response
     */
    public function synchronizeAllUser(SynchronizeAllUserRequest $request, User $user, SavingTemp $savingTemp);

    /**
     * Unsynchronize transaction for specific user.
     *
     * @param  App\Http\Requests\Savings\UnsynchronizeSpecificUserRequest $request
     * @param  App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function unsynchronizeSpecificUser(UnsynchronizeSpecificUserRequest $request,
        Saving $saving);

    /**
     * Unsynchronize transaction for all user.
     *
     * @param  App\Http\Requests\Savings\UnsynchronizeAllUserRequest $request
     * @param  App\User  $user
     * @param  App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function unsynchronizeAllUser(UnsynchronizeAllUserRequest $request, User $user, Saving $saving);

    /**
     * Handle the transaction life cycle process.
     *
     * @param  mixed  $data
     * @param  string  $action
     * @param  mixed  $model
     * @return \Illuminate\Http\Response
     */
    public function processingSavingLifeCycle($data, $action, $model = null);

    /**
     * Get all savings by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSavings(Request $request, User $user);

    /**
     * Get all savings_temp by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSavingsTemp();
}
