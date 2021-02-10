<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
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
            'video' => 'required|max:191',
            'time' => 'required|max:191',
            'category_id' => 'required',
            'description' => 'required',
            'image' => 'required',
        ];

    }



    public function messages()
    {
        return [
            'title.required' => 'Video Title Field cannot be Null!!',
            'title.max' => 'Video title accept only less than 191 character!!',
            'video.required' => 'Video ID Field cannot be Null!!',
            'video.max' => 'Video ID accept only less than 191 character!!',
            'time.required' => 'Video Tile Field cannot be Null!!',
            'time.max' => 'Video tile accept only less than 191 character!!',
            'category_id.required' => 'Please Select Video Category!!',
            'description.required' => 'Video description Field cannot be Null!!',
            'image.required' => 'Video Image cannot be Null!!',
        ];
    }
}
