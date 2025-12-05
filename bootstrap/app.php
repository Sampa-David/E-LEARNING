<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // ========== ENREGISTRER LES MIDDLEWARES PERSONNALISÉS ==========
        // Ces middlewares sont disponibles globalement dans l'application
        
        // Middleware pour vérifier le rôle de l'utilisateur
        // Utilisation: Route::middleware('check.role:student,teacher')->group(...)
        $middleware->alias([
            'check.role' => \App\Http\Middleware\CheckRole::class,
            'check.permission' => \App\Http\Middleware\CheckPermission::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->booted(function () {
        // Force HTTPS in production for mixed content fix
        if (env('APP_ENV') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    })->create();
