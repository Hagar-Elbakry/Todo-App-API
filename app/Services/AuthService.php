<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthService
{
    protected $authRepository;
    /**
     * Create a new class instance.
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function authRegister($request) {
            $request = $request->all();
            $request['password'] = Hash::make($request['password']);
            return $this->authRepository->userRegister($request);
    }

    public function authLogin($request) {
        if(!(Auth::attempt(['email' => $request['email'], 'password' => $request['password']]))) {
            return false;
        }

        $response = Http::asForm()->post(url('/oauth/token'), [
            'grant_type' => 'password',
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '',
        ]);

        $authResponse = $response->json();
        if(!empty($authResponse)) {
            $authUser = Auth::user();
            return [
                'name' => $authUser->name,
                'email' => $authUser->email,
                'access_token' => $authResponse['access_token'],
                'expires_in' => $authResponse['expires_in'],
                'refresh_token' => $authResponse['refresh_token']
            ];
        }
        return [];
    }

    public function userProfile() {
        return Auth::user();
    }

    public function userLogout() {
       $authUser = Auth::user();
       if ($authUser) {
              $authUser->token()->revoke();
              return true;
       }
         return false;
    }

    public function getAuthUser() {
        return Auth::user();
    }

    public function refreshToken($request) {
        $response = Http::asForm()->post(url('/oauth/token'), [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->refresh_token,
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'), // Required for confidential clients only...
            'scope' => '',
        ]);
        $authResponse = $response->json();
        if(!empty($authResponse)) {
            return [
                'access_token' => $authResponse['access_token'],
                'expires_in' => $authResponse['expires_in'],
                'refresh_token' => $authResponse['refresh_token']
            ];
        }
        return [];
    }
}
