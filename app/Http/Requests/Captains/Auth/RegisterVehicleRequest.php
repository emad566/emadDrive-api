<?php

namespace App\Http\Requests\Captains\Auth;

use Illuminate\Validation\Rule;
use App\Http\Requests\APIRequest;

class RegisterVehicleRequest extends APIRequest
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
            'owner_name' => 'required|min:3|max:100',
            'owner_national_id' => 'required|numeric',
            'registration_plate' => 'required|unique:captain_vehicles',
            'brand' => 'required|min:1|max:100',
            'model' => 'required|min:2|max:100',
            'color' => 'required|min:3|max:15',
            'model_date' => 'required|date_format:Y-m-d',
            'registration_type' => 'required',
            //'class_id' => 'required',
            'is_owner' => 'required|boolean',
            'insurance_expire_date' => 'required|date_format:Y-m-d|before:today',
            'insurance_company_name' => 'required|min:3|max:100',
        ];*/
        return [
            "files"    => "required|array|min:1",
            //"files.*"  => "required|min:3",
            "images"    => "required|array|min:6",
            "images.*"  => "required|min:3",
        ];
    }
}
