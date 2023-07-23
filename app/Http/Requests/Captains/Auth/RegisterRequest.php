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
        /*
        return [
            'full_name' => 'required|unique:captains|min:3|max:100',
            'city_id' => 'required|numeric',
            'country_code' => 'required|min:2',
            'mobile' => ['required','unique:captains',new Phone],
            'blood_type' => ['required' , Rule::in(['A+','O+','B+','AB+','A-','O-','B-','AB-'])],
            'birthplace' => 'required|min:3|max:200',
            'birthday' => 'required',
            'gender' => ['required', Rule::in(['male','female'])],
            'nationality' => 'required|min:3|max:100',
            'national_id' => 'required|unique:captains',
            'national_expiry_date' => 'required|date_format:Y-m-d|after:today',
            'license_expiry_date' => 'required|date_format:Y-m-d|after:today',
            'avatar' => 'required|min:20',
            'device_id' => 'required|numeric',
            'device_type' => ['required', Rule::in(['ios', 'android', 'web'])],
        ];
        */
        return [
            'mobile' => ['required','unique:captains',new Phone],
            'country_code' => 'required|min:2',
            'avatar' => 'required|min:20',
            'device_id' => 'required',
            'device_type' => ['required', Rule::in(['ios', 'android', 'web'])],
            "files"    => "required|array|min:2",
            "files.*"  => "required|min:3",
        ];
    }
}
