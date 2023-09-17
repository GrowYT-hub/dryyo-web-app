<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
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
            'request_id' => 'required|string',
            'categories_id' => 'required|string',
            'categories_name' => 'required|string',
            'quantity' => 'required|string',
            'subCategories' => 'required',
            'type_id' => 'required|string',
            'type_name' => 'required|string',
        ];
    }
}
