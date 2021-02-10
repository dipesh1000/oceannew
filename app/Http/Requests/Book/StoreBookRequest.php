<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'book_type' => 'required',
            'category_id' => 'required',
            'image' => 'required',
            'book_file' => 'required',
        ];

    }



    public function messages()
    {
        return [
            'title.required' => 'Book Title Field cannot be Null!!',
            'title.max' => 'Book title accept only less than 191 character!!',
            'book_type.required' => 'Select Book Type!!',
            'category_id.required' => 'Please Select Book Category!!',
            'description.required' => 'Book description Field cannot be Null!!',
            'image.required' => 'Book Image cannot be Null!!',
            'image.required' => 'Book Image cannot be Null!!',
        ];
    }
}
