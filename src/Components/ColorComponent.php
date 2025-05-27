<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Laraeast\LaravelBootstrapForms\Contracts\Components\LocalizableComponent;
use Laraeast\LaravelBootstrapForms\Components\Traits\HasMinLengthAndMaxLengthAttributes;
use Laraeast\LaravelBootstrapForms\Traits\LocalizableComponent as LocalizableComponentTrait;

class ColorComponent extends TextualComponent
{
    use HasMinLengthAndMaxLengthAttributes;

    /**
     * The component view path.
     */
    protected string $viewPath = 'color';
}