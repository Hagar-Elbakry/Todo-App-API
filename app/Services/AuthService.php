<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;

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
}
