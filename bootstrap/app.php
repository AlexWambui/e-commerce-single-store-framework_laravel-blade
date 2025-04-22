<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\ActiveMiddleware;
use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Middleware\AdminMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'active' => ActiveMiddleware::class,
            'super_admin' => SuperAdminMiddleware::class,
        ]);

        $middleware->group('authenticated_user', [
            'auth',
            'active',
            'verified',
        ]);

        $middleware->group('admin_only', [
            'auth',
            'active',
            'verified',
            'admin',
        ]);

        $middleware->group('super_admin_only', [
            'auth',
            'active',
            'verified',
            'super_admin',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
