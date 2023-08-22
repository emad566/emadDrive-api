<?php

namespace App\Services;

use App\Http\Controllers\API\V1\General\ConstantController;
use App\Http\Controllers\API\V1\General\OptionsController;
use Illuminate\Support\Facades\DB;

class CaptainHome{
    public static function Details($captain): array
    {
        $data = [
            'captain_code' => $captain->captain_code,
            'is_active' => $captain->is_active,
            'status' => $captain->status,
            'nationality' => $captain->nationality,
            'avatar' => $captain->avatar,
            'email' => $captain->email,
            'mobile' => $captain->mobile,
            'birthday' => $captain->birthday,
            'gender' => $captain->gender,
            'full_name' => $captain->full_name,
            'register_step' => $captain->register_step,
            'is_dark_mode' => $captain->is_dark_mode,
            'lang' => $captain->lang,
            'remember_token' => $captain->remember_token,
            'options'=>[
                'device_types'=>OptionsController::DEVICE_TYPES,
                'gender'=>OptionsController::GENDER,
                'years'=>OptionsController::YEARS,
                'colors'=>OptionsController::COLORS,
                'brands'=>OptionsController::BRANDS,
            ],
        ];
        return $data;
    }
}
