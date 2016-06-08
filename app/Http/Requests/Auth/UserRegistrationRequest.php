<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class UserRegistrationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|confirmed|min:6',
            'institution_name'      => 'required|max:255',
            'institution_address'   => 'required|max:255',
            'g-recaptcha-response'  => 'required|captcha',
            'accept_terms'          => 'required',
        ];
    }

}
