<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Laraeast\LaravelBootstrapForms\Contracts\Components\LocalizableComponent;
use Laraeast\LaravelBootstrapForms\Components\Traits\HasMinLengthAndMaxLengthAttributes;
use Laraeast\LaravelBootstrapForms\Traits\LocalizableComponent as LocalizableComponentTrait;

class TextComponent extends TextualComponent implements LocalizableComponent
{
    use LocalizableComponentTrait, HasMinLengthAndMaxLengthAttributes;

    /**
     * The component view path.
     *
     * @var string
     */
    protected $viewPath = 'text';
}