<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Success JSON response
     */
    protected function success(
        string $message = 'Success',
        mixed $data = null,
        int $code = 200
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
            'errors'  => null,
        ], $code);
    }

    /**
     * Error JSON response
     */
    protected function error(
        string $message = 'Something went wrong',
        mixed $errors = null,
        int $code = 422
    ): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => null,
            'errors'  => $errors,
        ], $code);
    }

    /**
     * Created response (201)
     */
    protected function created(
        string $message = 'Resource created successfully',
        mixed $data = null
    ): JsonResponse {
        return $this->success($message, $data, 201);
    }

    /**
     * Deleted response
     */
    protected function deleted(
        string $message = 'Resource deleted successfully'
    ): JsonResponse {
        return $this->success($message, null, 200);
    }

    /**
     * Not found response
     */
    protected function notFound(
        string $message = 'Resource not found'
    ): JsonResponse {
        return $this->error($message, null, 404);
    }
}
