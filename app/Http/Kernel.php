<?php

namespace App\Http;

use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Middleware\EnsureWebUserLogin;
use App\Http\Middleware\LogRequests;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        // Other middleware...
        'ensureToken' => EnsureTokenIsValid::class,
        'ensureWebUserLogin' => EnsureWebUserLogin::class,
        'logRequests' => LogRequests::class,
    ];
}
