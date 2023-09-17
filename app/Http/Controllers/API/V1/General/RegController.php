<?php

namespace App\Http\Controllers\API\V1\General;
use App\Http\Controllers\Controller;


class RegController extends Controller
{
    //Options
    const EMAIL = 'regex:/^[a-zA-Z0-9\.\-\_]+@[a-zA-Z0-9\.\-\_]+\.[a-zA-Z]{2,}$/';
}
