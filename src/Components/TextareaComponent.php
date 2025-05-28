<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Laraeast\LaravelBootstrapForms\Contracts\Components\LocalizableComponent;
use Laraeast\LaravelBootstrapForms\Traits\LocalizableComponent as LocalizableComponentTrait;

class TextareaComponent extends TextualComponent implements LocalizableComponent
{
    use LocalizableComponentTrait;

    /**
     * The component view path.
     */
    protected string $viewPath = 'textarea';

    /**
     * Set textarea cols attribute.
     */
    public function cols(int $cols): self
    {
        $this->attributes['cols'] = $cols;

        return $this;
    }

    /**
     * Set textarea rows attribute.
     */
    public function rows(int $rows): self
    {
        $this->attributes['rows'] = $rows;

        return $this;
    }
}
