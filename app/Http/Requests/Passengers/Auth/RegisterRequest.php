<?php

namespace App\Http\Requests\Passengers\Auth;

use App\Http\Controllers\API\V1\General\OptionsController;
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
            // Mobile UI data
            'full_name' => 'required|min:2|max:25',
            'mobile' => ['required','unique:passengers',new Phone],
            'avatar' => 'nullable:min:5,max:191',
            'device_token' => 'required|min:20|max:300',
            'device_id' => 'required',
            'device_type' => ['required', Rule::in(OptionsController::DEVICE_TYPES)],

            // Optional data
            'city_id' => 'nullable|numeric',
            'country_code' => 'nullable|min:2',
            'email' => 'nullable|email|max:50|unique:passengers,email',
            'gender' => ['nullable', Rule::in(OptionsController::GENDER)],
        ];
    }
}
