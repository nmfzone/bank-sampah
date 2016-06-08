<?php

namespace App\Awesome\Contracts\Controllers\Admin;

use App\Category;

use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;

interface CategoryContract
{
    /**
     * Display a listing of the category.
     *
     * @param  App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category);

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create();

    /**
     * Store a newly created category in storage.
     *
     * @param  App\Http\Requests\Categories\CreateCategoryRequest  $request
     * @param  App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request, Category $category);

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @param  App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id, Category $category);

    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @param  App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Category $category);

    /**
     * Update the specified category in storage.
     *
     * @param  App\Http\Requests\Categories\UpdateCategoryRequest $request
     * @param  int  $id
     * @param  App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id, Category $category);

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @param  App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Category $category);
}
