<?php

namespace App\Http\Requests\Passengers\Auth;

use App\Http\Requests\APIRequest;
use App\Rules\Phone;

class LoginRequest extends APIRequest
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
            'mobile' => ['required',new Phone],
            'device_token'=>'nullable',
        ];
    }
}
