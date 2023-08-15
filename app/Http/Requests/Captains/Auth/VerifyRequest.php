<?php

namespace App\Http\Requests\Captains\Auth;

use App\Rules\Phone;
use App\Http\Requests\APIRequest;


class VerifyRequest extends APIRequest
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
            'mobile' => ['required', 'exists:verifies,mobile', new Phone],
            'verification_code' => 'required|numeric',
            'device_token'=>'required',
        ];
    }
}
