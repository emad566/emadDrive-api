<?php

namespace App\Exceptions;
 use Exception;

class ExceptionPromoCode extends Exception { 

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * 
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json( [
            'status' => 0,
            'message' => __("promo code not valid"),
        ], 200);
    }
}