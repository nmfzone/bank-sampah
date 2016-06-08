<?php

namespace App\Http\Requests\Savings;

use Gate;
use App\Http\Requests\Request;

class UpdateSavingRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = auth()->user()->role;

        return Gate::allows('update-saving', $role);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'   => 'sometimes|required|exists:categories,id',
            'user_id'       => 'required|exists:users,id',
            'type_id'       => 'sometimesrequired|exists:types,id',
            'items_amount'  => 'sometimes|required|digits_between:1,20',
            'credit'        => 'sometimes|required|digits_between:1,20',
            'status'        => 'numeric|digits:1'
        ];
    }

}
