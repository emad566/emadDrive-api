<?php

namespace App\Http\Controllers\API\V1\Passengers;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponder;
use Illuminate\Support\Facades\Auth;

class   HomeController extends Controller
{
    use ApiResponder;

    /**
     * Home Details
     * @return mixed
     */
    public function details()
    {
        try {
            $passenger = Auth::user();
            $data = [
                'passenger_code' => $passenger->passenger_code,
                'full_name' => $passenger->full_name,
                'gender' => $passenger->gender,
                'mobile' => $passenger->mobile,
                'email' => $passenger->email,
                'avatar' => $passenger->avatar,
                'shake_phone' => $passenger->shake_phone,
                'vat' => $passenger->vat,
                'status' => $passenger->status,
                'is_dark_mode' => $passenger->is_dark_mode,
                'lang' => $passenger->lang,
            ];
            return $this->respondWithItem($data);
        } catch (\Throwable $th) {
            return $this->errorInternalError();
        }
    }

}
