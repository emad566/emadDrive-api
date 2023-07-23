<?php

namespace App\Http\Controllers\API\V1\Passengers\Auth;

use Carbon\Carbon;
use App\Models\Verify;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Passengers\Auth\LoginRequest;
use App\Http\Requests\Passengers\Auth\VerifyRequest;
use App\Http\Resources\Passengers\PassengerResource;
use App\Http\Requests\Passengers\Auth\RegisterRequest;
use App\Services\Check;

class AuthController extends Controller
{
    /**
     * Send Code Use SMS
     * @param  LoginRequest $request
     * @return mixed
     */
    public function sendCode(LoginRequest $request)
    {
        // 1 - Get Passenger and Set Locale Lang

        // 2 - Check Number Of Try OTP

        // 3 - Set OTP and Store with Expire at Verify Model

        //return $this->successStatus('Send SMS Successfully Please Check Your Phone');
    }

    /**
     * @param  VerifyRequest $request
     * @return mixed
     */
    public function check(VerifyRequest $request)
    {
        // 1- Check OTP using Check::CheckCode -> if success false return error

        // 2- Check if Passenger Old -> if new return response new user respondNewUser(true)

        // 3- Set Passenger Locale Lang app()->setLocale

        // 4 - Delete Old Passenger Token from table oauth_access_tokens

        // 5 - Create New Token
        //$token = $passenger->createToken('Token-Passenger', ['allow-passenger'])->accessToken;

        // 6 - Set token "remember_token" and device_token at passenger

        // 7 - Set Device Type and Token at $passenger->tokenable()


        // 8 - Check passenger Wallet if not exsist create new

        // 9 - Return passenger Data

    }

    /**
     * Register Passenger
     * @param  RegisterRequest $request
     * @return mixed
     */
    public function registerPassenger(RegisterRequest $request)
    {
        // 1- Create Passenger
        /**
         * 'passenger_code' => generateRandomCode('PAS'),
         * full_name
         * mobile
         * 'gender' => 'male',
         * avatar
         * device_token
         * lang
         */

        // 2- Create Capatin Document
        /**
         *
         * $captain->documents()
         * $request->get('files')[0] => ConstantController::NATIONAL_ID_FRONT
         * $request->get('files')[1] => ConstantController::NATIONAL_ID_BACK
         *
         */

        // 3 - Create New Token
        //$token = $passenger->createToken('Token-Passenger', ['allow-passenger'])->accessToken;

        // 4 - Set token "remember_token"  at passenger


        // 5 - Set Device Type , Device ID and Token at $passenger->tokenable()


        // 6- Create Wallet for Passenger

        // 7 - Return passenger Data
    }
}
