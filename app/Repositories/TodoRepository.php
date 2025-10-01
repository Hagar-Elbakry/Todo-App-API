<?php

namespace App\Repositories;

use App\Models\Todo;

class TodoRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function storeTodo($request) {
        return Todo::create($request);
    }
}
