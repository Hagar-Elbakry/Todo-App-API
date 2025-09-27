<?php

namespace App\Helper;

class ApiResponse
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function success($status = 'success', $message = null, $data = [], $code = 200) {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public static function error($status = 'error', $message = null, $code = 500) {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $code);
    }
   }
