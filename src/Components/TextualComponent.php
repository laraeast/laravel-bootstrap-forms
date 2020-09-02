<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Laraeast\LaravelBootstrapForms\Components\Traits\HasPlaceholder;

abstract class TextualComponent extends BaseComponent
{
    use HasPlaceholder;

    /**
     * Initialized the input arguments.
     *
     * @param null $name
     * @param null $value
     * @return $this
     */
    public function init($name = null, $value = null)
    {
        $this->name($name);

        $this->value($value ?: old($name));

        $this->setDefaultLabel();

        $this->setDefaultNote();

        $this->setDefaultPlaceholder();

        return $this;
    }
}