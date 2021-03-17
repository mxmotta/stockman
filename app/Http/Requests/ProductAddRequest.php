<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
{
    protected $errorBag = 'productAdd';

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
            '*.name'        =>  ['required'],
            '*.price'       =>  ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            '*.quantity'    =>  ['required'],
        ];
    }

    public function messages()
    {
        return [
            '*.name.required'       => 'Name is required.',
            '*.price.required'      => 'Price is required.',
            '*.price.regex'         => 'Price must be a valid value.',
            '*.quantity.required'   => 'Quantity is required.'
        ];
    }
}
