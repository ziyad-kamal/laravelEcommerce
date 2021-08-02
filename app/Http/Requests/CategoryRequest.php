<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            //'category'               => 'required|array|min:1',
            'category.*.name'        => 'required|min:3',
            'category.*.description' => 'required|min:3',
        ];
    }


    public function messages()
    {
        return[
            'required' => 'this field is required',
            'min'      => 'you should write at least 3 characters'
        ];
    }
}
