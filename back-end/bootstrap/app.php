<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Helpers\ApiResponse;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (PDOException $e, Request $request) {
            Log::error($e);
            return ApiResponse::error('Erro no banco de dados', 500, app()->isLocal() ? [
                'error' => $e->getMessage()
            ] : null);
        });

        $exceptions->render(function (ValidationException $e, Request $request) {
            return ApiResponse::error('Erro de validação', 422, $e->errors());
        });
        
        $exceptions->render(function (Throwable $e, Request $request) {
            return ApiResponse::error(
                app()->isLocal() ? $e->getMessage() : 'Erro interno do servidor',
                500
            );
        });

    })->create();
