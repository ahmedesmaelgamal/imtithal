<?php

namespace App\Traits;


class ApiTrait
{
    public function successResponse($data, $message = 'Success', $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function errorResponse($message, $code = 400)
    {
        return response()->json([
            'status' => false,
            'msg' => $message,
            "error" => $message
        ], $code);
    }
}
