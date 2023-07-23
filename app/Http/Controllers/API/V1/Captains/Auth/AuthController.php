<?php

namespace App\Http\Controllers\API\V1\Captains\Auth;

use Carbon\Carbon;
use App\Models\Verify;
use App\Models\Captain;
use App\Services\Check;
use Illuminate\Http\Request;
use App\Jobs\SendNotification;
use App\Models\CaptainVehicle;
use App\Models\CaptainBankAccount;
use App\Models\CaptainDocument;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Captains\Auth\LoginRequest;
use App\Http\Requests\Captains\Auth\VerifyRequest;
use App\Http\Requests\Captains\Auth\BankAccountRequest;
use App\Http\Requests\Captains\Auth\RegisterRequest;
use App\Http\Controllers\API\V1\General\ConstantController;
use App\Http\Controllers\API\V1\General\TypeConstant;
use App\Http\Requests\Captains\Auth\RegisterVehicleRequest;
use App\Models\CaptainWallet;

class AuthController extends Controller
{

    public function sendCode(LoginRequest $request)
    {
        // 1 - Get Captain and Set Locale Lang

        // 2 - Check Number Of Try OTP

        // 3 - Set OTP and Store with Expire at Verify Model

        return $this->successStatus('Send SMS Successfully Please Check Your Phone');
    }

    public function check(VerifyRequest $request)
    {

        // 1- Check OTP using Check::CheckCode -> if success false return error

        // 2- Check if Capain Old -> if new return response new user respondNewUser(true)

        // 3- Set Captain Locale Lang app()->setLocale

        // 4 - Delete Old Captain Token from table oauth_access_tokens

        // 5 - Create New Token
        //$token = $captain->createToken('Token-Captain', ['allow-captain'])->accessToken;

        // 6 - Set token "remember_token" and device_token at Captain


        // 7 - Set Device Type and Token at $captain->tokenable()


        // 8 - Check Captain Wallet if not exsist create new

        // 9 - Return Captain Data

    }

    public function registerCaptain(RegisterRequest $request)
    {
        // 1- Create Captain
        /**
         * 'captain_code' => generateRandomCode('CPT'),
         * mobile
         * 'gender' => 'male',
         * avatar
         * device_token
         * 'register_step' => ConstantController::REGISTER_STEP_ONE,
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
        //$token = $captain->createToken('Token-Captain', ['allow-captain'])->accessToken;

        // 4 - Set token "remember_token"  at Captain


        // 5 - Set Device Type , Device ID and Token at $captain->tokenable()



        // 6- Create Wallet for Captain


        // 7- return $this->respondRegisterStepOne($token, ConstantController::REGISTER_STEP_ONE);
    }

    public function registerVehicle(RegisterVehicleRequest $request)
    {
        // 1- Update register_step to ConstantController::REGISTER_STEP_TWO

        // 2- Create CaptainVehicle

        // 3 - Store  $request->images at vehicleMedias()
        //$request['names'] = ConstantController::VEHCICLE_IMAGES;

        // 4 - Create Captain Document for Vechile
        /**
         *
         * CaptainDocument
         * $request->get('files')[0] => ConstantController::VEHICLE_LICENSE_FRONT
         * $request->get('files')[1] => ConstantController::VEHICLE_LICENSE_BACK
         *
         */

        $title = __('Register');
        $body = __('The registration has been completed successfully. The application will be reviewed by the administration');
        //SendNotification::dispatch(Auth::guard('captain')->user(), $title, $body, TypeConstant::NEW_CAR); ##Queue

        return $this->successStatus('Vehicle register successfully');
    }

    public function registerBankAccount(BankAccountRequest $request)
    {
        // 1- Update register_step to ConstantController::REGISTER_STEP_THREE

        // 2- Create Bank Accout For Captain

        return $this->successStatus(__('Bank register successfully'));
    }
}
