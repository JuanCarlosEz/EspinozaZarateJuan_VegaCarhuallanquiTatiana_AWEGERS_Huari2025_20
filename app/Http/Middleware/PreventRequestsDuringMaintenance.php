<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * URIs que deben ser accesibles durante mantenimiento.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
