<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            // Load user routes
            Route::middleware('web')
                ->group(base_path('routes/user/panel.php'));
    
            // Load admin routes
            Route::middleware('web')
                ->group(base_path('routes/admin/panel.php'));
        },
    )
    ->withMiddleware(new App\Http\AppMiddleware())
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
