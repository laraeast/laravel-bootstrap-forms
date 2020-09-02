<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Laraeast\LaravelBootstrapForms\Components\Traits\HasMinAndMaxAttributes;

class NumberComponent extends TextualComponent
{
    use HasMinAndMaxAttributes;

    /**
     * The component view path.
     *
     * @var string
     */
    protected $viewPath = 'number';
}