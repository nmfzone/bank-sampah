<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Awesome\Contracts\Controllers\Admin\CategoryContract;

use App\Category;

use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;

class CategoryController extends Controller implements CategoryContract
{
    /**
     * The constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the category.
     *
     * @param  App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $pageTitle = "Daftar Kategori";
        $categories = $category->paginate(100);

        return view('dashboard.admin.categories.list', compact('pageTitle', 'categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Tambah Kategori";

        return view('dashboard.admin.categories.create', compact('pageTitle'));
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  App\Http\Requests\Categories\CreateCategoryRequest  $request
     * @param  App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request, Category $category)
    {
        $category->create($request->all());
        alert()->success('Kategori baru berhasil ditambahkan.')->persistent("Close");

        return redirect('/dashboard/protected/categories');
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @param  App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id, Category $category)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @param  App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Category $category)
    {
        $pageTitle = "Edit Kategori";
        $category = $category->findOrFail($id);

		return view('dashboard.admin.categories.edit', compact('pageTitle', 'category'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  App\Http\Requests\Categories\UpdateCategoryRequest $request
     * @param  int  $id
     * @param  App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id, Category $category)
    {
        $category = $category->findOrFail($id);
        $category->update($request->all());
        alert()->success('Detail kategori berhasil di update.')->persistent("Close");

        return redirect('/dashboard/protected/categories');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @param  App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Category $category)
    {
        $category = $category->findOrFail($id);
        $category->delete();
        alert()->success('Kategori berhasil di hapus.')->persistent("Close");

        return redirect('/dashboard/protected/categories');
    }
}
