<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use App\Project\Frontend\Repo\Vehicle\EloquentVehicle;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Laravel\Passport\Exceptions\MissingScopeException;

class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \League\OAuth2\Server\Exception\OAuthServerException::class,
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (ValidationException $e, $request) {
            if ($request->expectsJson()) {
                return response('Sorry, validation failed.', 422);
            }
        });
    }
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            // return [
            //     'status' => 0,
            //     'message' => __('Unauthenticated'),
            // ];
            return response()->json([
                'status' => 0,
                'massage' => __('Unauthenticated')
            ], 401);
        }
        return redirect()->guest('login');
    }

    public function MissingScopeException($request, MissingScopeException $exception)
    {
        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return response()->json([
                'status' => 0,
                'massage' => __('This type of user cannot do this action.')
            ]);
        }

        return parent::render($request, $exception);
    }
}
