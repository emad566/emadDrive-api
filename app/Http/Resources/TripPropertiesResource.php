<?php

namespace App\Http\Resources;

use App\Models\Property;
use Illuminate\Http\Resources\Json\JsonResource;

class TripPropertiesResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'is_captain_in_trip' => $this->in_trip,
            'is_captain_available_for_trip' => $this->available,
            'properties' => Property::select(['id', getLangKey('title') . ' as title'])->active()->orderBy(getLangKey('title'), 'ASC')->get(),
            'selected_properties_ids' => $this->tripProperties,
        ];
    }
}
