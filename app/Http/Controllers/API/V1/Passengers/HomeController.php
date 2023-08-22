<?php

namespace App\Http\Controllers\API\V1\Passengers;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponder;
use App\Services\PassengerHome;
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
            return $this->respondWithItem(PassengerHome::Details($passenger));
        } catch (\Throwable $th) {
            return $this->errorInternalError();
        }
    }

}
