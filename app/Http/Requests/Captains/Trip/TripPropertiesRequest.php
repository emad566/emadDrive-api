<?php

namespace App\Http\Requests\Captains\Trip;

use App\Http\Controllers\API\V1\General\OptionController;
use App\Http\Requests\APIRequest;

class TripPropertiesRequest extends APIRequest
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
            'toggle_available' => 'required|boolean',
            'selected_properties_ids' => 'required|array',
            'selected_properties_ids.*' => 'nullable|exists:properties,id',
            'map_lat' => 'required|numeric',
            'map_long' => 'required|numeric',
        ];
    }
}
