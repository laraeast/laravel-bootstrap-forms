<?php

namespace Laraeast\LaravelBootstrapForms\Components;

class RadioComponent extends BaseComponent
{
    /**
     * The component view path.
     */
    protected string $viewPath = 'radio';

    protected bool $checked = false;

    /**
     * Initialized the input arguments.
     */
    public function init(...$arguments): self
    {
        $this->name($name = $arguments[0] ?? null);

        $this->value($arguments[1] ?? null ?: old($name));

        $this->checked = $arguments[2] ?? false;

        $this->setDefaultLabel($name);

        $this->setDefaultNote($name);

        $this->setDefaultPlaceholder($name);

        return $this;
    }

    public function checked(?bool $checked = true): self
    {
        $this->checked = (bool) $checked;

        return $this;
    }

    /**
     * The registered variables in view component.
     */
    protected function viewComposer(): array
    {
        return [
            'checked' => $this->checked,
        ];
    }
}
