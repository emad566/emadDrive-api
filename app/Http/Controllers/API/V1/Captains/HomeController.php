<?php

namespace App\Http\Controllers\API\V1\Captains;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponder;
use App\Services\CaptainHome;
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
            return $this->respondWithItem(CaptainHome::Details($captain));
        } catch (\Throwable $th) {
            return $this->errorInternalError(th: $th);
        }
    }

}
