<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof \Illuminate\Validation\ValidationException) {
            return $this->convertValidationExceptionToResponse($e, $request);
        }

        elseif ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            $this->report($e);
            abort(404); // Model niet gevonden exception
        }

        else
        {
            $this->report($e);
            abort(404); // Model niet gevonden exception
        }
    }

    public function report(Throwable $exception)
    {
        if ($this->shouldReport($exception)) {
            Log::channel('errorlog')->error($exception->getMessage(), ['exception' => $exception]);
        }

        parent::report($exception);
    }
}
