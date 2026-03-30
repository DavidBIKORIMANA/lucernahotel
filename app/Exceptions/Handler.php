<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

        // --- Database constraint violations (duplicate entry, FK, etc.) ---
        $this->renderable(function (QueryException $e, $request) {
            $errorCode = $e->errorInfo[1] ?? null;
            $message = 'A database error occurred. Please try again.';

            // 1062 = Duplicate entry
            if ($errorCode == 1062) {
                // Extract the duplicate value from the error message
                if (preg_match("/Duplicate entry '(.+?)' for key/", $e->getMessage(), $matches)) {
                    $message = "The value '{$matches[1]}' already exists. Please use a different value.";
                } else {
                    $message = 'This record already exists. Please use a different value.';
                }
            }
            // 1451 = Cannot delete, foreign key constraint (child rows exist)
            elseif ($errorCode == 1451) {
                $message = 'Cannot delete this record because it is linked to other data. Remove the related records first.';
            }
            // 1452 = Cannot add/update, foreign key reference invalid
            elseif ($errorCode == 1452) {
                $message = 'Invalid reference. The selected related record does not exist.';
            }
            // 1048 = Column cannot be null
            elseif ($errorCode == 1048) {
                if (preg_match("/Column '(.+?)' cannot be null/", $e->getMessage(), $matches)) {
                    $field = str_replace('_', ' ', $matches[1]);
                    $message = "The field '{$field}' is required.";
                } else {
                    $message = 'A required field is missing. Please fill in all required fields.';
                }
            }
            // 1406 = Data too long for column
            elseif ($errorCode == 1406) {
                $message = 'One of the values you entered is too long. Please shorten it and try again.';
            }

            if ($request->expectsJson()) {
                return response()->json(['message' => $message], 422);
            }

            $notification = [
                'message'    => $message,
                'alert-type' => 'error',
            ];

            return redirect()->back()->withInput()->with($notification);
        });

        // --- Model not found (invalid ID in URL) ---
        $this->renderable(function (ModelNotFoundException $e, $request) {
            $model = class_basename($e->getModel());
            $message = "{$model} not found.";

            if ($request->expectsJson()) {
                return response()->json(['message' => $message], 404);
            }

            $notification = [
                'message'    => $message,
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        });

        // --- 404 page not found ---
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Page not found.'], 404);
            }
            // Let Laravel's default 404 view handle it
        });
    }
}
