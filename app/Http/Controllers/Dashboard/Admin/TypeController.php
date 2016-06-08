<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Awesome\Contracts\Controllers\Admin\TypeContract;

use App\Type;

use App\Http\Requests\Types\CreateTypeRequest;
use App\Http\Requests\Types\UpdateTypeRequest;

class TypeController extends Controller implements TypeContract
{
    /**
     * Display a listing of the type.
     *
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function index(Type $type)
    {
        $pageTitle = "Daftar Tipe Sampah";
        $types = $type->paginate(100);

        return view('dashboard.admin.types.list', compact('pageTitle', 'types'));
    }

    /**
     * Show the form for creating a new type.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Tambah Tipe Sampah";

        return view('dashboard.admin.types.create', compact('pageTitle'));
    }

    /**
     * Store a newly created type in storage.
     *
     * @param  App\Http\Requests\Types\CreateTypeRequest  $request
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTypeRequest $request, Type $type)
    {
        $type->create($request->all());
        alert()->success('Tipe sampah baru berhasil ditambahkan.')->persistent("Close");

        return redirect('/dashboard/protected/types');
    }

    /**
     * Display the specified type.
     *
     * @param  int  $id
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show($id, Type $type)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified type.
     *
     * @param  int  $id
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Type $type)
    {
        $pageTitle = "Edit Tipe Sampah";
        $type = $type->findOrFail($id);

		return view('dashboard.admin.types.edit', compact('pageTitle', 'type'));
    }

    /**
     * Update the specified type in storage.
     *
     * @param  App\Http\Requests\Types\UpdateTypeRequest $request
     * @param  int  $id
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeRequest $request, $id, Type $type)
    {
        $type = $type->findOrFail($id);
        $type->update($request->all());
        alert()->success('Detail tipe sampah berhasil di update.')->persistent("Close");

        return redirect('/dashboard/protected/types');
    }

    /**
     * Remove the specified type from storage.
     *
     * @param  int  $id
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Type $type)
    {
        $type = $type->findOrFail($id);
        $type->delete();
        alert()->success('Tipe sampah berhasil di hapus.')->persistent("Close");

        return redirect('/dashboard/protected/types');
    }
}
