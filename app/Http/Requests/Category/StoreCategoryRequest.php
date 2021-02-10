<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'title' => 'required|max:191',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Category Title Field cannot be Null!!',
            'title.max' => 'Category title accept only less than 191 character!!',
        ];
    }
}
