<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\App;

trait ApiResponder
{

    protected $statusCode = 200;
    protected $success = 1;
    protected $failure = 0;
    protected $is_debug = false;
    protected $catch_error;

    function __construct (){
        $this->is_debug = App::hasDebugModeEnabled();
    }

    public function setCatchError($th=null){

        $this->catch_error = ($th != null && $this->is_debug )  ? $th->getMessage() . ": line"."[".$th->getLine()."]" : 'Release Mode';
        return $this;
    }

    /**
     * Getter for statusCode
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
     /**
     * Getter for statusCode
     *
     * @return int
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * Setter for statusCode
     *
     * @param int $statusCode Value to set
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    protected function respond($data, $headers = [])
    {
        return response()->json($data, $this->statusCode, $headers);
    }

    public function successStatus($message = 'Success Request')
    {
        return $this->respond([
            'status' => $this->getSuccess(),
            'message' => __($message),
        ]);
    }
    public function errorStatus($message = 'Failure Request')
    {
        return $this->respond([
            'status' => 0,
            'message' => __($message),
        ]);
    }
    public function respondNewUser($item, $message = 'Success Request')
    {
        return $this->respond([
            'status' => $this->getSuccess(),
            'message' => __($message),
            'is_new'=> $item
        ]);
    }
    public function respondRegisterStepOne($item,$step, $message = 'Success Request')
    {
        return $this->respond([
            'status' => $this->getSuccess(),
            'message' => __($message),
            'register_step'=> $step,
            'data' => $item,
        ]);
    }
    public function respondRegisterSteps($step, $message = 'Success Request')
    {
        return $this->respond([
            'status' => $this->getSuccess(),
            'message' => __($message),
            'register_step'=> $step,
        ]);
    }
    public function respondOldUser($item, $message = 'Success Request')
    {
        return $this->respond([
            'status' => $this->getSuccess(),
            'message' => __($message),
            'is_new'=> false,
            'data' => $item,
        ]);
    }
    public function respondWithItem($item,$message = 'Success Request')
    {
        return $this->respond([
            'status' => $this->getSuccess(),
            'message' => __($message),
            'data' => $item,
        ]);
    }
    public function respondWithItemName($item_name,$item, $message = 'Success Request')
    {
        return $this->respond([
            'status' => $this->getSuccess(),
            'message' => __($message),
            $item_name => $item,
        ]);
    }

    public function respondWithCollection($collection,$message='Success Request')
    {
        return $this->respond([
            'status' => $this->getSuccess(),
            'message' => __($message),
            'data' => $collection,
        ]);
    }

    public function respondWithMessage($message)
    {
        return $this->setStatusCode(200)
            ->respond([
                'status' => $this->getSuccess(),
                'message' => __($message)
            ]);
    }

    public function respondNoContent($message = 'No content')
    {
        return $this->setStatusCode(204)
            ->respond([
                'http_code' => $this->getStatusCode(),
                'message' => __($message)
            ]);
    }

    public function respondCreated($data, $message = 'Resource created successfully')
    {
        return $this->setStatusCode(201)
            ->respond([
                'status' => $this->getSuccess(),
                'message' => __($message),
                'data' => $data,
            ]);
    }

    protected function respondWithError($message)
    {
        if (! is_array($message)) {
            $message = [
                'body' => [__($message)]
            ];
        }

        return $this->respond([
            'http_code' => $this->getStatusCode(),
            'error' => [
                'catch_error' => $this->catch_error,
                'message' => __('Internal Error'),
            ]
        ]);
    }

    /**
     * Generates a Response with a 403 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)->respondWithError($message);
    }

    /**
     * Generates a Response with a 500 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorInternalError($message = 'Internal Error', $th=null)
    {

        return $this->setStatusCode(500)->setCatchError($th)->respondWithError($message);
    }

    /**
     * Generates a Response with a 404 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * Generates a Response with a 401 HTTP header and a given message.
     *
     * @return Response
     */
    public function unauthenticated($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)->respondWithError($message);
    }

    /**
     * Generates a Response with a 400 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorWrongArgs($message)
    {
        return $this->setStatusCode(400)->respondWithError($message);
    }
}
