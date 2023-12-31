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
        // item's routes 
        "api/matiere/create", 
        "api/matiere/delete", 
        "api/matiere/update", 
        "api/matiere/increase", 
        "api/matiere/decrease", 
        "api/matiere/data", 
        "api/matiere/search", 

        // entry's routes 
        "api/entree/create", 
        "api/entree/delete", 
        "api/entree/search", 
        "api/entree/count", 
        "api/entree/readPage", 
        "api/entree/search/date", 
        "api/entree/search/date_keyword", 

        // sortie's routes 
        "api/sortie/create", 
        "api/sortie/delete", 
        "api/sortie/search", 
        "api/sortie/count", 
        "api/sortie/search/date", 
        "api/sortie/search/date_keyword"
    ];
}
