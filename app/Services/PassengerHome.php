<?php

namespace App\Services;

use App\Http\Controllers\API\V1\General\ConstantController;
use App\Http\Controllers\API\V1\General\OptionsController;
use Illuminate\Support\Facades\DB;

class PassengerHome{
    public static function Details($passenger): array
    {
        $data = [
            'passenger_code' => $passenger->passenger_code,
            'full_name' => $passenger->full_name,
            'mobile' => $passenger->mobile,
            'email' => $passenger->email,
            'avatar' => $passenger->avatar,
            'shake_phone' => $passenger->shake_phone,
            'remember_token' => $passenger->remember_token,
            'rate' => $passenger->rate,
            'status' => $passenger->status,
            'suspend' => $passenger->suspend,
            'lang' => $passenger->lang,
            'is_dark_mode' => $passenger->is_dark_mode,
            'options'=>[
              'device_types'=>OptionsController::DEVICE_TYPES,
              'gender'=>OptionsController::GENDER,
            ],
        ];
        return $data;
    }
}
