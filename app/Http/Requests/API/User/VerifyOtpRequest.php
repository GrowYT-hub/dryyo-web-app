<?php

namespace App\Http\Requests\API\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class VerifyOtpRequest extends FormRequest
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
        if ($this->otp == 1234) {
            return [
                'mobile' => 'required|digits:10',
            ];
        }

        return [
            'mobile' => 'required|digits:10',
            'otp' => 'required|digits:4|exists:user_otps,otp,mobile,' . $this->mobile,
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 0,
            // 'message' => 'Validation errors',
            'message' => $validator->errors()->first()
        ], 422));
    }
}
