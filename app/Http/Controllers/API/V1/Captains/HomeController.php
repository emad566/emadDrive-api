<?php

namespace App\Http\Controllers\API\V1\Captains;

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
            $captain = Auth::user();

            $data = [
                'is_active' => $captain->is_active,
                'status' => $captain->status,
                'nationality' => $captain->nationality,
                'avatar' => $captain->avatar,
                'email' => $captain->email,
                'mobile' => $captain->mobile,
                'birthday' => $captain->birthday,
                'gender' => $captain->gender,
                'full_name' => $captain->full_name,
                'captain_code' => $captain->captain_code,
                'register_step' => $captain->register_step,
                'is_dark_mode' => $captain->is_dark_mode,
                'lang' => $captain->lang,
            ];
            return $this->respondWithItem($data);
        } catch (\Throwable $th) {
            return $this->errorInternalError(th: $th);
        }
    }

}
