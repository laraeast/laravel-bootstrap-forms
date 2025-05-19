<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Laraeast\LaravelBootstrapForms\Components\Traits\HasMinLengthAndMaxLengthAttributes;

class EmailComponent extends TextualComponent
{
    use HasMinLengthAndMaxLengthAttributes;

    /**
     * The component view path.
     */
    protected string $viewPath = 'email';
}