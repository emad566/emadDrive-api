<?php

namespace App\Http\Requests\Passengers\Auth;

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
            'full_name' => 'required|min:2|max:25',
            'city_id' => 'required|numeric',
            'country_code' => 'required|min:2',
            'mobile' => ['required','unique:passengers',new Phone],
            'gender' => ['required', Rule::in(['male','female'])],
            'avatar' => 'nullable',
            'device_id' => 'required',
            'device_type' => ['required', Rule::in(['ios', 'android', 'web'])],
        ];
    }
}
