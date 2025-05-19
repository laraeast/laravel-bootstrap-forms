<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Laraeast\LaravelBootstrapForms\Components\Traits\HasMinAndMaxAttributes;

class DateComponent extends TextualComponent
{
    use HasMinAndMaxAttributes;

    /**
     * The component view path.
     */
    protected string $viewPath = 'date';
}