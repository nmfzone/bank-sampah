<?php

namespace App\Http\Requests\Savings;

use Gate;
use App\Http\Requests\Request;

class CreateSavingRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = auth()->user()->role;

        return Gate::allows('create-saving', $role);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'   => 'required|exists:categories,id',
            'user_id'       => 'required|exists:users,id',
            'type_id'       => 'required|exists:types,id',
            'items_amount'  => 'required|digits_between:1,20',
            'status'        => 'numeric|digits:1'
        ];
    }

}
