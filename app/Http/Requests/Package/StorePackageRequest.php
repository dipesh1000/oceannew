<?php

namespace App\Http\Requests\Package;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
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
            'package_type' => 'required',
            'description' => 'required',
            'image' => 'required',
        ];

    }



    public function messages()
    {
        return [
            'title.required' => 'Book Title Field cannot be Null!!',
            'title.max' => 'Book title accept only less than 191 character!!',
            'package_type.required' => 'Select Package Type!!',
            'description.required' => 'Package description Field cannot be Null!!',
            'image.required' => 'Package Image cannot be Null!!',
        ];
    }
}
