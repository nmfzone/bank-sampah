<?php

namespace App\Http\Requests\Users;

use Gate;
use App\Http\Requests\Request;

class CreateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();

        return Gate::allows('create-users-man', $user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'              => 'required|max:255|alpha_dash|unique:users',
            'id_card_number'        => 'required|digits_between:5,255',
            'name'                  => 'required|max:255|unique:users',
            'email'                 => 'email|max:255|unique:users',
            'password'              => 'required|confirmed|min:6',
            'address'               => 'required',
            'phone'                 => 'required',
        ];
    }

}
