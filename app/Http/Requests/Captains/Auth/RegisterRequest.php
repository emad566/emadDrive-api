<?php

namespace App\Http\Requests\Captains\Auth;

use App\Http\Controllers\API\V1\General\OptionController;
use App\Http\Controllers\API\V1\General\RegController;
use App\Rules\Phone;
use App\Http\Controllers\API\V1\General\OptionsController;
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
            // Mobile UI
            'mobile' => ['required','unique:captains',new Phone],
            'avatar' => 'required|min:3|max:191',
            'device_token' => 'required|min:3|max:191',
            'device_id' => 'required|min:3|max:191',
            'device_type' => ['required', Rule::in(OptionsController::DEVICE_TYPES)],
            'national_id_front' => 'required|min:3|max:191',
            'national_id_back' => 'required|min:3|max:191',
            'driving_license_front' => 'required|min:3|max:191',
            'is_dark_mode' => 'nullable|min:0|max:1',

            // Optional Fields
            'full_name' => 'nullable|min:3|max:30',
            'gender' => ['nullable', Rule::in(OptionsController::GENDER)],
            'birthday' => 'nullable|min:3|max:30',
            'email' => 'nullable|email|'.RegController::EMAIL.'|max:50|unique:captains,email',
            'password' => 'nullable|min:6|max:10',
            'city' => 'nullable|min:4|max:30',
            'national_expiry_date' => 'nullable|date_format:Y-m-d|after:yesterday',
            'driving_license_back' => 'nullable|min:3|max:191',
            'license_expiry_date' => 'nullable|date_format:Y-m-d|after:yesterday',
        ];
    }
}
