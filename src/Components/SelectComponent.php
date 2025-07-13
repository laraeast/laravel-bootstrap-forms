<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Laraeast\LaravelBootstrapForms\Components\Traits\HasPlaceholder;

class SelectComponent extends BaseComponent
{
    use HasPlaceholder;

    /**
     * The component view path.
     */
    protected string $viewPath = 'select';

    protected array $options = [];

    /**
     * Initialized the input arguments.
     */
    public function init(...$arguments): self
    {
        $this->name($name = $arguments[0] ?? null);

        $this->value($arguments[2] ?? null ?: old($name) ?: request($name));

        $this->options = $arguments[1] ?? [];

        $this->setDefaultLabel($name);

        $this->setDefaultNote($name);

        $this->setDefaultPlaceholder($name);

        $this->setDefaultStyle();

        return $this;
    }

    public function options(array $options = []): self
    {
        $this->options = $options;

        return $this;
    }

    public function multiple(bool $multiple = true): self
    {
        if ($multiple) {
            $this->attributes['multiple'] = 'multiple';
        }

        return $this;
    }

    /**
     * The registered variables in view component.
     */
    protected function viewComposer(): array
    {
        return [
            'options' => $this->options,
        ];
    }
}
