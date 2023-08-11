<?php

namespace App\Services;

use App\Http\Controllers\API\V1\General\ConstantController;
use Illuminate\Support\Facades\DB;

class UpdateToken{
    public static function Update($model,  $device_type, $device_token, $model_type='passenger'){
        // Set Model Locale Lang app()->setLocale
        app()->setLocale($model->lang);

        // Delete Old Model Token from table oauth_access_tokens
        DB::table('oauth_access_tokens')
            ->where('user_id', $model->id)
            ->where('name', $model_type=='passenger'? ConstantController::TOKEN_PASSENGER : ConstantController::TOKEN_CAPTAIN)
            ->delete();

        // Create New Token
        $token = ($model_type=='passenger')?
                $model->createToken(ConstantController::TOKEN_PASSENGER, ['allow-passenger'])->accessToken
                : $model->createToken(ConstantController::TOKEN_CAPTAIN, ['allow-captain'])->accessToken;

        // Set token "remember_token" and device_token at passenger
        $model->update([
            'remember_token' => $token,
            'device_token' => $device_token,
        ]);

        // Set Device Type and Token at $passenger->tokenable()
        $model->tokenable()->update([
            'device_type' => $device_type,
            'token' => $token,
        ]);

        // Check Model Wallet if not exsist create new
        if(!$model->wallet){
            $model->wallet()->create([
                'balance' => 0,
                'status' => true,
            ]);
        }

        // Return Model Data
        return $model;
    }
}
