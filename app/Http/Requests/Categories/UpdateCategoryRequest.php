<?php

namespace App\Http\Requests\Categories;

use Gate;
use App\Http\Requests\Request;

class UpdateCategoryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = auth()->user()->role;

        return Gate::allows('update-category', $role);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('categories');

        return [
            'name'  => 'required|max:255|unique:categories,name,'.$id,
            'price' => 'required|numeric|positive',
        ];
    }

}
