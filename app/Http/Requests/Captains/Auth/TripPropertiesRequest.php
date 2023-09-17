<?php

namespace App\Http\Requests\Captains\Auth;

use App\Http\Controllers\API\V1\General\OptionController;
use App\Http\Controllers\API\V1\General\RegController;
use App\Rules\Phone;
use App\Http\Controllers\API\V1\General\OptionsController;
use Illuminate\Validation\Rule;
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
        ];
    }
}
