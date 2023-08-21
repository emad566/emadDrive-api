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
            'registration_plate' => 'required|min:6|max:6|unique:captain_vehicles,registration_plate',
            'brand' => 'required|min:2|max:20',
            'model' => 'required|min:2|max:20',
            'model_date' => 'required|numeric|min:2000|max:2030',
            'color' => 'required|min:3|max:20',
            'vehicle_front' => 'required|min:5|max:191',
            'vehicle_back' => 'required|min:5|max:191',
            'vehicle_left' => 'required|min:5|max:191',
            'vehicle_right' => 'required|min:5|max:191',
            'vehicle_front_seat' => 'required|min:5|max:191',
            'vehicle_back_seat' => 'required|min:5|max:191',
            'vehicle_license_front' => 'required|min:5|max:191',
            'vehicle_license_back' => 'required|min:5|max:191',
            'vehicle_license_expire_date' => 'required|date_format:Y-m-d|after:yesterday',
        ];
    }
}
