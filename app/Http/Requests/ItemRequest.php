<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name'        => 'required|string|max:20|min:3',
            'description' => 'required|string|max:200|min:3',
            'condition'   => 'required',
            'category_id' => 'required',
            'price'       => 'required|numeric',
            'photo'       => 'required_without:photo_id|image|mimes:jpg,gif,jpeg,png|max:14',
        ];
    }


    public function messages()
    {
        return[
            'name.required'          => 'you should enter name',
            'name.max'               => 'you should enter less than 20 characters',
            'description.required'   => 'you should enter description',
            'description.min'        => 'you should more than 3 characters',
            'condition.required'     => 'you should select condition',
            'price.required'         => 'you should enter price',
            'photo.required_without' => 'you should select photo',
            'photo.mimes'            => 'photo is invalid',
            'photo.max'              => 'size should be less than 14MB'
        ];
    }
}
