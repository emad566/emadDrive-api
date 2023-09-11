<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Verify;
use App\Models\Captain;
use App\Http\Traits\ApiResponder;
use Illuminate\Support\Facades\DB;

class Check
{
    use ApiResponder;

    public static function CheckCode($request)
    {

        $response['success'] = true;
        $verify = Verify::whereMobile($request->mobile)->latest()->first();


        if (empty($verify?->verification_code)) {
            $response['success'] = false;
            if($request->header('Accept-Language')=='ar'){
                $response['message'] = 'رمز التحقيق مطلوب';
            }
            else{
                $response['message'] = 'Verification code is missing';
            }
        }

        if ($verify?->verification_code != $request->verification_code) {
            $response['success'] = false;
            if($request->header('Accept-Language')=='ar'){
                $response['message'] = 'رمز التحقيق خطأ';
            }
            else{
                $response['message'] = 'Verification code is wrong';
            }
        }


        if ($verify && Carbon::parse($verify->verification_expiry_minutes)->lte(Carbon::now())) {
            $response['success'] = false;
            if($request->header('Accept-Language')=='ar'){
                $response['message'] = 'رمز التحقيق منتهي';
            }
            else{
                $response['message'] = 'Verification code is expired';
            }
        }
        return $response;
    }
}
