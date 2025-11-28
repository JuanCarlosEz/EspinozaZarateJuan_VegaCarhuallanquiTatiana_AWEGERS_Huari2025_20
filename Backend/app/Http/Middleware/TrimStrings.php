<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * Atributos que no deben ser recortados.
     *
     * @var array<int, string>
     */
    protected $except = [
        'password',
        'password_confirmation',
    ];
}
