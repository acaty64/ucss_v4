<?php

namespace App\Http;

use App\Acceso;
use Illuminate\Auth\Middleware\Auth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Styde\Html\Alert\Middleware::class,
        ],

        'master' => [
            'web',
            'auth',
            Authorize::class.':is_master,'.Acceso::class,
        ],

        'consulta' => [
            'web',
            'auth',
            Authorize::class.':is_consulta,'.Acceso::class,
        ],

        'docente' => [
            'web',
            'auth',
            Authorize::class.':is_docente,'.Acceso::class,
        ],

        'responsable' => [
            'web',
            'auth',
            'docente',
            Authorize::class.':is_responsable,'.Acceso::class,
        ],        

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'Access' => Styde\Html\Facades\Access::class,
    ];
}
