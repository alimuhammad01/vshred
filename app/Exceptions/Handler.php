<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'sccuess' => false,
                'message' => 'Entry not found',
                'code' => 404
            ], 404);
        }

        if ($exception instanceof ValidationException) {
            return response()->json([
                'sccuess' => false,
                'message' => 'Data is not valid',
                'errors' => $exception->errors(),
                'code' => 400
            ], 400);
        }

        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'sccuess' => false,
                'message' => 'Unauthorized',
                'code' => 401
            ], 401);
        }

        return response()->json([
            'sccuess' => false,
            'message' => $exception->getMessage(),
            'code' => 400
        ], 400);

        return parent::render($request, $exception);
    }
}
