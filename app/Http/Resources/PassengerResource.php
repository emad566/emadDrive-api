<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PassengerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'avatar' => $this->avatar,
            'email' => $this->email,
            'gender' => $this->gender,
            'full_name' => $this->full_name,
            'passenger_code' => $this->passenger_code,
            'token' => $this->remember_token,
        ];
    }
}
