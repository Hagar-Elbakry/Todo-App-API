<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function userRegister($userRequest)
    {
        return User::create($userRequest);
    }

}
