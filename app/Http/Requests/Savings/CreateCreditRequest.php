<?php

namespace App\Http\Requests\Savings;

use Gate;
use App\Http\Requests\Request;

class CreateCreditRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = auth()->user()->role;

        return Gate::allows('create-credit', $role);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'       => 'required|exists:users,id',
            'credit'        => 'required|digits_between:1,20|positive',
        ];
    }

}
