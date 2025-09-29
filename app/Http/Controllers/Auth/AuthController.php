<?php

namespace App\Http\Controllers\Auth;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLogin;
use App\Http\Requests\AuthRegister;
use App\Services\AuthService;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected  $authService;
   public function __construct(AuthService $authService) {
         $this->authService = $authService;
   }
    public function register(AuthRegister $request) {
        try {
           $response =  $this->authService->authRegister($request);
           if($response) {
               return ApiResponse::success(status: self::SUCCESS_STATUS, message: self::SUCCESS_MESSAGE, data: $response, code: self::SUCCESS_CODE);
           }
           return ApiResponse::error(status: self::ERROR_STATUS, message: self::REGISTER_ERROR_MESSAGE, code: self::ERROR_CODE);
        }catch (\Exception $e) {
            Log::error('Exception Occurred while registering user: '.$e->getMessage());
            return ApiResponse::error(status: self::ERROR_STATUS, message: self::EXCEPTION_MESSAGE, code: self::VALIDATION_ERROR_CODE);
        }
    }

    public function login(AuthLogin $request) {
            try{
                $loginResponse = $this->authService->authLogin($request);
                if(!$loginResponse) {
                    return ApiResponse::error(status: self::ERROR_STATUS, message: self::INVALID_CREDENTIALS_MESSAGE, code: self::ERROR_CODE);
                }
                    return ApiResponse::success(status: self::SUCCESS_STATUS, message: self::SUCCESS_MESSAGE, data: $loginResponse, code: self::SUCCESS_CODE);
            } catch(\Exception $e) {
                Log::error('Exception Occurred while logging in user: '.$e->getMessage());
                return ApiResponse::error(status: self::ERROR_STATUS, message: self::ERROR_MESSAGE, code: self::VALIDATION_ERROR_CODE);
            }
    }

    public function profile() {
       try {
           $authUser =  $this->authService->userProfile();
           if(!$authUser) {
               return ApiResponse::error(status: self::ERROR_STATUS, message: self::UNFOUND_USER_MESSAGE, code: self::ERROR_CODE);
           }
              return ApiResponse::success(status: self::SUCCESS_STATUS, message: self::SUCCESS_MESSAGE, data: $authUser, code: self::SUCCESS_CODE);
       } catch(\Exception $e) {
           Log::error('Exception Occurred while getting user profile: '.$e->getMessage());
              return ApiResponse::error(status: self::ERROR_STATUS, message: self::EXCEPTION_MESSAGE, code: self::VALIDATION_ERROR_CODE);
    }
    }
}
