<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public const SUCCESS_STATUS = 'success';
    public const ERROR_STATUS = 'error';

    public const SUCCESS_MESSAGE = 'Request processed successfully';
    public const ERROR_MESSAGE = 'Request processing failed';
    public const REGISTER_ERROR_MESSAGE = 'Registration failed. Please try again.';
    public const INVALID_CREDENTIALS_MESSAGE = 'Invalid credentials. Please check your email and password.';

    public const EXCEPTION_MESSAGE = 'An unexpected error occurred. Please try again later.';
    public const UNFOUND_USER_MESSAGE = 'User not found.';
    public const LOGOUT_ERROR_MESSAGE = 'Logout failed. Please try again.';
    public const LOgoUT_SUCCESS_MESSAGE = 'User logged out successfully';
    public const TODO_CREATION_SUCCESS_MESSAGE = 'Todo created successfully';
    public const TODO_CREATION_ERROR_MESSAGE = 'Todo creation failed. Please try again.';

    public const SUCCESS_CODE = 200;
    public const ERROR_CODE = 500;
    public  const VALIDATION_ERROR_CODE = 422;
    public const CREATED_CODE = 201;
}
