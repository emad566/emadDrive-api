<?php

namespace App\Http\Controllers\API\V1\Captains\Auth;

use App\Http\Resources\CaptainResource;
use App\Models\Captain;
use App\Services\SendCode;
use App\Services\UpdateToken;
use App\Services\Check;
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
            if(!$response[ConstantController::SUCCESS]){
                return $this->errorStatus($response[ConstantController::MESSAGE]);
            }

            // Check if Model Old -> if new return response new user respondNewUser(true)
            $captain = Captain::where('mobile', $request->mobile)->first();
            if(!$captain) return  $this->respondNewUser(true);

            // Update Token
            DB::beginTransaction();
            $captain = UpdateToken::update(
                $captain,
                $request->header('platform') == 1? 'android' : 'ios',
                $request->device_token,
                'captain'
            );
            DB::commit();

            // Return passenger Data

            return $this->respondWithItem(new CaptainResource($captain));
        } catch (\Throwable $th) {
            return $this->errorInternalError(th: $th);
        }
    }

    public function registerCaptain(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            // Create Captain
            $captain = Captain::create([
                'register_step' => ConstantController::REGISTER_STEP_ONE,
                'captain_code' => generateRandomCode('CPT'),
                'full_name' => $request->full_name,
                'mobile' => $request->mobile,
                'gender' => 'male',
                'avatar' => $request->avatar,
                'device_token' => $request->device_token,
                'lang' => $request->header(ConstantController::ACCEPT_LANGUAGE)?? 'en',
                'password'=> $request->password?? '',
            ]);

            // 2- Create Captain Document
            $captain->documents()->createMany([
                [
                    'name' => ConstantController::NATIONAL_ID_FRONT,
                    'file' => $request->get('files')[0],
                ],
                [
                    'name' => ConstantController::NATIONAL_ID_BACK,
                    'file' => $request->get('files')[1],
                ],

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
            return $this->respondRegisterStepOne($captain->remember_token, ConstantController::REGISTER_STEP_ONE);
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
            $vehicle = CaptainVehicle::create(['captain_id'=>$captain->id]);

            // Store  $request->images at vehicleMedias()
            $vehicle_images = [];
            foreach ($request->images as $key => $vehicle_image){
                $vehicle_images[] = [
                    'image' => $vehicle_image,
                    'name' => $key,
                ];
            }
            $vehicle->vehicleMedias()->createMany($vehicle_images);

            // 4 - Create Captain Document for Vehicle
            if($request->get('files')[0]){
                CaptainDocument::create([
                    'captain_id'=> $captain->id,
                    'file'=> $request->get('files')[0],
                    'name'=> ConstantController::VEHICLE_LICENSE_FRONT,
                    'vehicle_id'=> $vehicle->id,
                ]);
            }

            if($request->get('files')[1]){
                CaptainDocument::create([
                    'captain_id'=> $captain->id,
                    'file'=> $request->get('files')[1],
                    'name'=> ConstantController::VEHICLE_LICENSE_BACK,
                    'vehicle_id'=> $vehicle->id,
                ]);
            }
            DB::commit();

            $title = __('Register');
            $body = __('The registration has been completed successfully. The application will be reviewed by the administration');
            //SendNotification::dispatch(Auth::guard('captain')->user(), $title, $body, TypeConstant::NEW_CAR); ##Queue

            return $this->respondRegisterSteps(ConstantController::REGISTER_STEP_TWO);

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

            return $this->respondRegisterSteps(ConstantController::REGISTER_STEP_THREE, 'Bank register successfully');
        } catch (\Throwable $th) {
            return $this->errorInternalError(th: $th);
        }
    }
}
