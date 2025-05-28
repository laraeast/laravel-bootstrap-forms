<?php

namespace Laraeast\LaravelBootstrapForms\Components;

class FileComponent extends BaseComponent
{
    /**
     * The component view path.
     */
    protected string $viewPath = 'file';

    /**
     * Initialized the input arguments.
     *
     * @param  mixed  ...$arguments
     * @return $this
     */
    public function init(...$arguments): self
    {
        $this->name($name = $arguments[0] ?? null);

        $this->setDefaultLabel($name);

        $this->setDefaultNote($name);

        return $this;
    }

    public function multiple(bool $multiple = true): self
    {
        if ($multiple) {
            $this->attributes['multiple'] = 'multiple';
        }

        return $this;
    }
}
