<?php

use App\Middlewares\EnsureApiKeyIsValid;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware
            ->alias([
                'api.quest' => \App\Middlewares\RejectIfAuthenticated::class,
            ])
            ->statefulApi()
            ->appendToGroup('api', EnsureApiKeyIsValid::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
