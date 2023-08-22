<?php

namespace App\Http\Requests\Captains\Auth;

use App\Http\Controllers\API\V1\General\OptionsController;
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
        return [
            // Mobile UI
            'vehicle_front' => 'required|min:5|max:191',
            'vehicle_back' => 'required|min:5|max:191',
            'vehicle_left' => 'required|min:5|max:191',
            'vehicle_right' => 'required|min:5|max:191',
            'vehicle_front_seat' => 'required|min:5|max:191',
            'vehicle_back_seat' => 'required|min:5|max:191',
            'vehicle_license_front' => 'required|min:5|max:191',
            'vehicle_license_back' => 'required|min:5|max:191',

            // Optional data
            'registration_plate' => 'nullable|min:6|max:6|unique:captain_vehicles,registration_plate',
            'brand' => ['nullable', 'min:2', 'max:20', Rule::in(OptionsController::GENDER)],
            'model' => 'nullable|min:2|max:20',
            'model_date' => ['nullable', Rule::in(OptionsController::YEARS)],
            'color' => ['nullable', Rule::in(OptionsController::COLORS)],
            'vehicle_license_expire_date' => 'nullable|date_format:Y-m-d|after:yesterday',
        ];
    }
}
