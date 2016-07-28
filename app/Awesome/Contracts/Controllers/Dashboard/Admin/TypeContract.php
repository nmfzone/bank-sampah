<?php

namespace App\Awesome\Contracts\Controllers\Dashboard\Admin;

use App\Type;

use App\Http\Requests\Types\CreateTypeRequest;
use App\Http\Requests\Types\UpdateTypeRequest;

interface TypeContract
{
    /**
     * Display a listing of the type.
     *
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function index(Type $type);

    /**
     * Show the form for creating a new type.
     *
     * @return \Illuminate\Http\Response
     */
    public function create();

    /**
     * Store a newly created type in storage.
     *
     * @param  App\Http\Requests\Types\CreateTypeRequest  $request
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTypeRequest $request, Type $type);

    /**
     * Display the specified type.
     *
     * @param  int  $id
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show($id, Type $type);

    /**
     * Show the form for editing the specified type.
     *
     * @param  int  $id
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Type $type);

    /**
     * Update the specified type in storage.
     *
     * @param  App\Http\Requests\Types\UpdateTypeRequest $request
     * @param  int  $id
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeRequest $request, $id, Type $type);

    /**
     * Remove the specified type from storage.
     *
     * @param  int  $id
     * @param  App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Type $type);
}
