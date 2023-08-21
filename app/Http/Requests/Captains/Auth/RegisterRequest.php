<?php

namespace App\Http\Requests\Captains\Auth;

use App\Rules\Phone;
use Illuminate\Validation\Rule;
use App\Http\Requests\APIRequest;

class RegisterRequest extends APIRequest
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
            'full_name' => 'required|min:3|max:30',
            'gender' => ['required', Rule::in(['male', 'femal'])],
            'birthday' => 'required|min:3|max:30',
            'mobile' => ['required','unique:captains',new Phone],
            'email' => 'required|email|max:50|unique:captains,email',
            'password' => 'required|min:6|max:10',
            'city' => 'nullable|min:4|max:30',
            'avatar' => 'required|min:3|max:191',
            'device_token' => 'required|min:3|max:191',
            'device_id' => 'required|min:3|max:191',
            'device_type' => ['required', Rule::in(['ios', 'android', 'web'])],
            'national_id_front' => 'required|min:3|max:191',
            'national_id_back' => 'required|min:3|max:191',
            'national_expiry_date' => 'required|date_format:Y-m-d|after:yesterday',
            'driving_license_front' => 'required|min:3|max:191',
            'driving_license_back' => 'required|min:3|max:191',
            'license_expiry_date' => 'required|date_format:Y-m-d|after:yesterday',
            'is_dark_mode' => 'nullable|min:0|max:1',
        ];
    }
}
