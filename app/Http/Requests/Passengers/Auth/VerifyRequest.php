<?php

namespace App\Http\Requests\Passengers\Auth;

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
            'verification_code' => 'required|numeric|min:0|max:9999',
            'device_token'=>'required:min:30|max:191',
        ];
    }
}
