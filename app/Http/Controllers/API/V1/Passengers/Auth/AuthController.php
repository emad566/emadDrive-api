<?php

namespace App\Http\Controllers\API\V1\Passengers\Auth;

use App\Http\Controllers\API\V1\General\ConstantController;
use App\Services\PassengerHome;
use App\Services\SendCode;
use App\Models\Passenger;
use App\Http\Controllers\Controller;
use App\Http\Requests\Passengers\Auth\LoginRequest;
use App\Http\Requests\Passengers\Auth\VerifyRequest;
use App\Http\Resources\PassengerResource;
use App\Http\Requests\Passengers\Auth\RegisterRequest;
use App\Services\Check;
use App\Services\UpdateToken;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Send Code Use SMS
     * @param  LoginRequest $request
     * @return mixed
     */
    public function sendCode(LoginRequest $request)
    {
        try {
            // Get Model and Set Locale Lang
            $passenger = Passenger::where('mobile', $request->mobile)->first();

            // Send Code and return response
            $sendCode =  new SendCode();
            return $sendCode->send($passenger, $request->mobile);
        } catch (\Throwable $th) {
            return $this->errorInternalError(th: $th);
        }
    }

    /**
     * @param  VerifyRequest $request
     * @return mixed
     */
    public function check(VerifyRequest $request)
    {
        try {
            // Check OTP using Check::CheckCode -> if success false return error
            $response = Check::CheckCode($request);
            if(!$response[ConstantController::SUCCESS]){
                return $this->errorStatus($response[ConstantController::MESSAGE]);
            }

            // Check if Passenger Old -> if new return response new user respondNewUser(true)
            $passenger = Passenger::where('mobile', $request->mobile)->first();
            if(!$passenger) return  $this->respondNewUser(true);

            // Update Token
            DB::beginTransaction();
            $passenger = UpdateToken::update(
                        $passenger,
                        $request->header('platform') == 1? 'android' : 'ios',
                        $request->device_token,
                        'passenger'
                    );
            DB::commit();

            // Return passenger Data
            return $this->respondWithItem(PassengerHome::Details($passenger));
        } catch (\Throwable $th) {
            return $this->errorInternalError(th: $th);
        }

    }

    /**
     * Register Passenger
     * @param  RegisterRequest $request
     * @return mixed
     */
    public function registerPassenger(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            // Create Passenger
            $passenger = Passenger::create([
                'passenger_code' => generateRandomCode('PAS'),
                'full_name' => $request->full_name,
                'mobile' => $request->mobile,
                'gender' => 'male',
                'avatar' => $request->avatar,
                'device_token' => $request->device_token,
                'lang' => $request->header(ConstantController::ACCEPT_LANGUAGE)?? 'en',
                'password'=> $request->password?? '',
            ]);

            // Update Token
            $passenger = UpdateToken::update(
                $passenger,
                $request->header('platform') == 1? 'android' : 'ios',
                $request->device_token,
                'passenger'
            );

            DB::commit();

            // Return passenger Data
            $passenger = Passenger::find($passenger->id);
            return $this->respondWithItem(PassengerHome::Details($passenger));
        } catch (\Throwable $th) {
            return $this->errorInternalError(th: $th);
        }
    }
}
