<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        "appartement/create", 
        "appartement/update", 
        "appartement/delete", 
        "appartement/total", 
        "appartement/minimum", 
        "appartement/maximum", 
        "appartement/min", 
        "appartement/max"
    ];
}
