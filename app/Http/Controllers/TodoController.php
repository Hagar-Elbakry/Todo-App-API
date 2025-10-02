<?php

namespace App\Http\Controllers;

use App\Helper\ApiResponse;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Serviecs\TodoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{

    public $todoService;

    function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function index()
    {
        try {
            $todos = $this->todoService->getAllTodos();
            return ApiResponse::success(status: self::SUCCESS_STATUS, message: self::SUCCESS_MESSAGE, data: $todos, code: self::SUCCESS_CODE);
        } catch (\Exception $e) {
            Log::error('Error While fetching todos: '.$e->getMessage());
            return ApiResponse::error(status: self::ERROR_STATUS, message: self::EXCEPTION_MESSAGE, code: self::VALIDATION_ERROR_CODE);
        }
    }

    public function store(TodoRequest $request)
    {
        try {
            $todo = $this->todoService->storeTodo($request);
            if ($todo) {
                return ApiResponse::success(status: self::SUCCESS_STATUS, message: 'Todo ' .  self::CREATION_SUCCESS_MESSAGE, data: $todo, code: self::CREATED_CODE);
            }
            return ApiResponse::error(status: self::ERROR_STATUS, message: 'Todo ' .  self::CREATION_ERROR_MESSAGE, code: self::ERROR_CODE);
        } catch (\Exception $e) {
            Log::error('Error While creating todo: '.$e->getMessage());
            return ApiResponse::error(status: self::ERROR_STATUS, message: self::EXCEPTION_MESSAGE, code: self::VALIDATION_ERROR_CODE);
        }
    }

    public function show(Todo $todo)
    {
        try {
            $todo = $this->todoService->getTodo($todo);
            if ($todo) {
                return ApiResponse::success(status: self::SUCCESS_STATUS, message: self::SUCCESS_MESSAGE, data: $todo, code: self::SUCCESS_CODE);
            }
            return ApiResponse::error(status: self::ERROR_STATUS, message: 'Todo ' . self::NOT_FOUND_MESSAGE, code: self::ERROR_CODE);
        } catch (\Exception $e) {
            Log::error('Error While fetching todo: '.$e->getMessage());
            return ApiResponse::error(status: self::ERROR_STATUS, message: self::EXCEPTION_MESSAGE, code: self::VALIDATION_ERROR_CODE);
        }

    }

    public function update(TodoRequest $request, Todo $todo)
    {
        try{
            $todo = $this->todoService->updateTodo($request, $todo);
            if($todo) {
                return ApiResponse::success(status: self::SUCCESS_STATUS, message: self::SUCCESS_MESSAGE, data: $todo, code: self::SUCCESS_CODE);
            }
            return ApiResponse::error(status: self::ERROR_STATUS, message: 'Todo ' . self::NOT_FOUND_MESSAGE, code: self::ERROR_CODE);
        }catch (\Exception $e){
            Log::error('Error While updating todo: '.$e->getMessage());
            return ApiResponse::error(status: self::ERROR_STATUS, message: self::EXCEPTION_MESSAGE, code: self::VALIDATION_ERROR_CODE);
        }
    }
}
