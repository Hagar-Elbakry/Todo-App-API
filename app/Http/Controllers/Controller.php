<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public const SUCCESS_STATUS = 'success';
    public const ERROR_STATUS = 'error';

    public const SUCCESS_MESSAGE = 'Request processed successfully';
    public const ERROR_MESSAGE = 'Something went wrong, please try again later';
    public const VALIDATION_ERROR_MESSAGE = 'The given data was invalid.';

    public const SUCCESS_CODE = 200;
    public const ERROR_CODE = 500;
    public  const VALIDATION_ERROR_CODE = 422;
}
