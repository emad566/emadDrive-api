<?php

namespace App\Http\Controllers\API\V1\Captains\Trip;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\V1\General\TypeConstant;

class TripController extends Controller
{
    function properties(){
        return $this->respondWithMessage('success');
    }
}
