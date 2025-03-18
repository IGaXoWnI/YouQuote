<?php

use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(EnsureFrontendRequestsAreStateful::class);
        $middleware->alias([
            'manage_citation' => App\Http\Middleware\manageCitation::class,
            'approve_citation' => App\Http\Middleware\approvedByAdmin::class,
            


        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
