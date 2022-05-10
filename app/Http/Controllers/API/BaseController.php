<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result = [], $message = "")
    {
    	$response = [
            'status' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * return success response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendSuccess($message)
    {
    	$response = [
            'status' => true,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($errorMessages, $statusCode = 404)
    {
    	$response = [
            'status' => false,
            'message' => $errorMessages,
        ];

        return response()->json($response, $statusCode);
    }
}
