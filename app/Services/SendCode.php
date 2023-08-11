<?php

namespace App\Services;

use App\Http\Controllers\API\V1\General\ConstantController;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponder;
use App\Models\Verify;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class SendCode {
    use ApiResponder;


    public function send($model, $mobile): JsonResponse
    {
        if($model){
            app()->setLocale($model->lang);
        }

        // 2 - Check Number Of Try OTP
        $lastCodes = Verify::where('mobile', $mobile)->latest()->take(5)->get();
        if($lastCodes->count()>=5 && $lastCodes->last()->created_at->addHour()> now()){
            return $this->errorStatus(__('try again after min',['minutes'=>date_diff($lastCodes->last()->created_at->addHour(), now())->i] ));
        }

        // 3 - Set OTP and Store with Expire at Verify Model
        $verification_code = '0000';
        Verify::create([
            'mobile'=>$mobile,
            'type'=>ConstantController::CHECk,
            'verification_code'=>$verification_code,
            'verification_expiry_minutes'=>Carbon::now()->addMinute(2),
        ]);

        return $this->successStatus('Send SMS Successfully Please Check Your Phone');
    }
}
