<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CaptainResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'avatar' => $this->avatar,
            'email' => $this->email,
            'gender' => $this->gender,
            'full_name' => $this->full_name,
            'captain_code' => $this->captain_code,
            'register_step' => $this->register_step,
            'token' => $this->remember_token,
        ];
    }
}
