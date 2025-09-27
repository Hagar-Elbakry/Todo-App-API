<?php

namespace App\Http\Controllers\Auth;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected  $authService;
    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }
    public function register(AuthRequest $request) {
        try {
           $response =  $this->authService->authRegister($request);
           if($response) {
               return ApiResponse::success(status: self::SUCCESS_CODE, message: self::SUCCESS_MESSAGE, data: $response, code: self::SUCCESS_CODE);
           }
           return ApiResponse::error(status: self::ERROR_STATUS, message: self::ERROR_MESSAGE, code: self::ERROR_CODE);
        }catch (\Exception $e) {
            Log::error('Exception Occurred while registering user: '.$e->getMessage());
            return ApiResponse::error(status: self::ERROR_STATUS, message: self::VALIDATION_ERROR_MESSAGE, code: self::VALIDATION_ERROR_CODE);
        }
    }
}
