<?php

namespace Laraeast\LaravelBootstrapForms\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;

class FormDirectives
{
    /**
     * Register all the form directives.
     *
     * @return void
     */
    public static function register()
    {
        $instance = new RegisterFormDirectives;

        collect(get_class_methods(RegisterFormDirectives::class))->each(function ($method) use ($instance) {
            if (Str::startsWith($method, 'register')) {
                $instance->{$method}();
            }
        });
    }
}