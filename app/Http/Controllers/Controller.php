<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function responseMsg($msg, $data = null, int $status = 200)
    {
        return response()->json([
            'msg' => $msg,
            'data' => $data,
            'status' => $status
        ]);
    }

    public function ExeptionResponse($msg = "تعذر الحصول على البيانات")
    {
        return response()->json([
            'msg' => $msg,
            'data' => null,
            'status' => 500
        ]);
    }
}
