<?php

namespace App\Http\Controllers\API\V1\Captains\Trip;

use App\Http\Controllers\Controller;
use App\Http\Resources\TripPropertiesResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    function properties(Request $request){
        try {
            $captain = Auth::user();
            if($request->toggle_available) $captain->update(['available'=>!$captain->available]);
            return $this->respondWithItem(new TripPropertiesResource($captain));
        } catch (\Throwable $th) {
            return $this->errorInternalError(th: $th);
        }

    }
}
