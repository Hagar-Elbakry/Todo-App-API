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

    public function getAllTodos($userId) {
        return Todo::where('user_id', $userId)->paginate(10);
    }
    public function storeTodo($request) {
        return Todo::create($request);
    }

    public function getTodo($todo, $userId) {
        return  $todo->where('user_id', $userId)->first();
    }

    public function updateTodo($request, $todo) {
        $todo->update($request->all());
        return $todo;
    }
}
