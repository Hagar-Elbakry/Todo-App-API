<?php

namespace App\Serviecs;

use App\Repositories\TodoRepository;
use App\Services\AuthService;

class TodoService
{
    public  $todoRepository, $authService;
    /**
     * Create a new class instance.
     */
    public function __construct(TodoRepository $todoRepository, AuthService $authService)
    {
        $this->todoRepository = $todoRepository;
        $this->authService = $authService;
    }

    public function getAllTodos() {
        $authUser = $this->authService->getAuthUser();
        return $this->todoRepository->getAllTodos($authUser->id);
    }

    public function storeTodo($request) {
        $authUser = $this->authService->getAuthUser();
        $request = $request->all();
        $request['user_id'] = $authUser->id;
        return $this->todoRepository->storeTodo($request);
    }

    public function getTodo($todo) {
        $authUser = $this->authService->getAuthUser();
        return $this->todoRepository->getTodo($todo, $authUser->id);
    }
}
