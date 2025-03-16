<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Languagerequest extends FormRequest
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
            'name'      => 'required|string|max:20|min:2',
            'direction' => 'required',
            'abbr'      => 'required|string|max:5|min:2',
        ];
    }


    public function messages()
    {
        return[
            'required'             => 'this field is required',
            'name.max'             => 'you should enter less than 20 characters',
            'min'                  => 'you should enter more than 2 characters',
        ];
    }
}
