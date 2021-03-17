<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductMovementRequest extends FormRequest
{
    protected $errorBag = 'productMovement';

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
            'quantity'    =>  ['required', 'not_in:0'],
        ];
    }

    public function messages()
    {
        return [
            'quantity.required'     => 'Quantity is required.',
            'quantity.not_in'          => 'Quantity must be more than 0.',
        ];
    }
}
