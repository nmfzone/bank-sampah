<?php

namespace App\Http\Requests\Types;

use Gate;
use App\Http\Requests\Request;

class CreateTypeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = auth()->user()->role;

        return Gate::allows('create-type', $role);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required|max:255|unique:types',
        ];
    }

}
