<?php

namespace App\Http\Controllers\API\V1\Captains\Auth;

use App\Models\Captain;
use App\Services\CaptainHome;
use App\Services\SendCode;
use App\Services\UpdateToken;
use App\Services\Check;
use App\Models\CaptainVehicle;
use App\Models\CaptainBankAccount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Captains\Auth\LoginRequest;
use App\Http\Requests\Captains\Auth\VerifyRequest;
use App\Http\Requests\Captains\Auth\BankAccountRequest;
use App\Http\Requests\Captains\Auth\RegisterRequest;
use App\Http\Controllers\API\V1\General\ConstantController;
use App\Http\Requests\Captains\Auth\RegisterVehicleRequest;

class AuthController extends Controller
{

    public function sendCode(LoginRequest $request)
    {
        try {
            // Get Model and Set Locale Lang
            $captain = Captain::where('mobile', $request->mobile)->first();

            // Send Code and return response
            $sendCode =  new SendCode();
            return $sendCode->send($captain, $request->mobile);

        } catch (\Throwable $th) {
            return $this->errorInternalError(th: $th);
        }
    }

    public function check(VerifyRequest $request)
    {

        try {

            // Check OTP using Check::CheckCode -> if success false return error
            $response = Check::CheckCode($request);

            // Check if Model Old -> if new return response new user respondNewUser(true)
            if($response['success']){
                $captain = Captain::where('mobile', $request->mobile)->first();
                if(!$captain) return  $this->respondWithItem(['is_new'=>true, 'user'=>null], __('Mobile number is not registered'));
            }

            if(!$response[ConstantController::SUCCESS]){
                return $this->errorStatus($response[ConstantController::MESSAGE]);
            }


            // Update Token
            DB::beginTransaction();
            $captain = UpdateToken::update(
                $captain,
                $request->header('platform') == 1? 'android' : 'ios',
                $request->device_token,
                'captain'
            );
            DB::commit();

            // Return Data
            return $this->respondWithItem(['is_new'=>false, 'user'=>CaptainHome::Details($captain)]);

        } catch (\Throwable $th) {
            return $this->errorInternalError(th: $th);
        }
    }

    public function registerCaptain(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            $captain = Captain::create([
                'register_step' => ConstantController::REGISTER_STEP_ONE,
                'captain_code' => generateRandomCode('CPT'),
                'full_name' => $request->full_name,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'password' => $request->password,
                'city' => $request->city,
                'avatar' => $request->avatar,
                'device_token' => $request->device_token,
                'device_id' => $request->device_id,
                'device_type' => $request->device_type,
                'lang' => $request->header(ConstantController::ACCEPT_LANGUAGE)?? 'en',
                'national_id_front' => $request->national_id_front,
                'national_id_back' => $request->national_id_back,
                'national_expiry_date' => $request->national_expiry_date,
                'driving_license_front' => $request->driving_license_front,
                'driving_license_back' => $request->driving_license_back,
                'license_expiry_date' => $request->license_expiry_date,
                'is_dark_mode' => $request->is_dark_mode,
            ]);


            // Update Token
            $captain = UpdateToken::update(
                $captain,
                $request->header('platform') == 1? 'android' : 'ios',
                $request->device_token,
                'captain'
            );

            DB::commit();

            // Return Model Data
            $captain = Captain::find($captain->id);
            return $this->respondWithItem(CaptainHome::Details($captain));
        } catch (\Throwable $th) {
            return $this->errorInternalError(th: $th);
        }
    }

    public function registerVehicle(RegisterVehicleRequest $request)
    {
        try {
            DB::beginTransaction();
            // Update register_step to ConstantController::REGISTER_STEP_TWO
            $captain = Auth::guard('captain')->user();
            $captain->update([ 'register_step' => ConstantController::REGISTER_STEP_TWO]);

            // Create CaptainVehicle
            $vehicle = CaptainVehicle::create([
                'captain_id'=>$captain->id,
                'registration_plate' => $request->registration_plate,
                'brand_id' => $request->brand_id,
                'carmodel_id' => $request->carmodel_id,
                'model_date' => $request->model_date,
                'color_id' => $request->color_id,
                'vehicle_front' => $request->vehicle_front,
                'vehicle_back' => $request->vehicle_back,
                'vehicle_left' => $request->vehicle_left,
                'vehicle_right' => $request->vehicle_right,
                'vehicle_front_seat' => $request->vehicle_front_seat,
                'vehicle_back_seat' => $request->vehicle_back_seat,
                'vehicle_license_front' => $request->vehicle_license_front,
                'vehicle_license_back' => $request->vehicle_license_back,
                'vehicle_license_expire_date' => $request->vehicle_license_expire_date,
            ]);


            DB::commit();

            $title = __('Register');
            $body = __('The registration has been completed successfully. The application will be reviewed by the administration');
            //SendNotification::dispatch(Auth::guard('captain')->user(), $title, $body, TypeConstant::NEW_CAR); ##Queue

            return $this->respondWithItem(CaptainHome::Details($captain));

        } catch (\Throwable $th) {
            return $this->errorInternalError(th: $th);
        }
    }

    public function registerBankAccount(BankAccountRequest $request)
    {
        try {
            DB::beginTransaction();
            // Update register_step to ConstantController::REGISTER_STEP_THREE
            $captain = Auth::guard('captain')->user();
            $captain->update([ 'register_step' => ConstantController::REGISTER_STEP_THREE]);

            // Create Bank Accout For Captain
            CaptainBankAccount::create([
                'captain_id' => $captain->id,
                'bank_name' => $request->bank_name,
                'iban_number' => $request->iban_number,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
            ]);
            DB::commit();

            return $this->respondWithItem(CaptainHome::Details($captain));
        } catch (\Throwable $th) {
            return $this->errorInternalError(th: $th);
        }
    }
}
