<?php

namespace App\Awesome\Contracts\Controllers\Admin;

use App\Saving;
use App\Category;
use App\Type;

use App\Http\Requests\Savings\CreateSavingRequest;
use App\Http\Requests\Savings\UpdateSavingRequest;
use App\Http\Requests\Savings\CreateCreditRequest;

interface SavingContract
{
    /**
     * Display a listing of the saving.
     *
     * @param  App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function index();

    /**
     * Show the form for creating a new saving.
     *
     * @param  App\Category  $category
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category, Type $type);

    /**
     * Store a newly created saving in storage.
     *
     * @param  App\Http\Requests\Savings\CreateSavingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSavingRequest $request);

    /**
     * Display the specified saving.
     *
     * @param  int  $id
     * @param  App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function show($id, Saving $saving);

    /**
     * Show the form for editing the specified saving.
     *
     * @param  int  $id
     * @param  App\Saving  $saving
     * @param  App\Category  $category
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Saving $saving, Category $category, Type $type);

    /**
     * Update the specified saving in storage.
     *
     * @param  App\Http\Requests\Savings\UpdateSavingRequest $request
     * @param  int  $id
     * @param  App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSavingRequest $request, $id, Saving $saving);

    /**
     * Remove the specified saving from storage.
     *
     * @param  int  $id
     * @param  App\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Saving $saving);

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
     * @return \Illuminate\Http\Response
     */
    public function createCredit(CreateCreditRequest $request);

    /**
     * Handle the transaction life cycle process.
     *
     * @param  string  $request
     * @param  string  $action
     * @return \Illuminate\Http\Response
     */
    public function processingSavingLifeCycle($request, $action);

    /**
     * Get all savings by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSavings();
}
