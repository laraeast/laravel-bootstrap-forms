<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Illuminate\Support\Facades\Config;

class CheckboxComponent extends BaseComponent
{
    /**
     * The component view path.
     */
    protected string $viewPath = 'checkbox';

    protected bool $checked = false;

    protected bool $hasDefaultValue = true;

    protected mixed $defaultValue = 0;

    /**
     * Set resource name property.
     */
    public function __construct(string $resource)
    {
        parent::__construct($resource);

        $this->hasDefaultValue = Config::get('laravel-bootstrap-forms.checkboxes.hasDefaultValue', true);
    }

    /**
     * Initialized the input arguments.
     */
    public function init(...$arguments): self
    {
        $this->name($name = $arguments[0] ?? null);

        $this->value($arguments[1] ?? null ?: old($name));

        $this->checked = $arguments[2] ?? false;

        $this->setDefaultLabel();

        $this->setDefaultNote();

        $this->setDefaultPlaceholder();

        return $this;
    }

    public function checked(?bool $checked = true): self
    {
        $this->checked = ! ! $checked;

        return $this;
    }

    public function default(mixed $value = 0): self
    {
        $this->hasDefaultValue = true;

        $this->defaultValue = $value;

        return $this;
    }

    public function withoutDefault(): self
    {
        $this->hasDefaultValue = false;

        return $this;
    }

    public function withDefault(): self
    {
        $this->hasDefaultValue = true;

        return $this;
    }

    /**
     * The variables with registered in view component.
     */
    protected function viewComposer(): array
    {
        return [
            'checked' => $this->checked,
            'hasDefaultValue' => $this->hasDefaultValue,
            'defaultValue' => $this->defaultValue,
        ];
    }
}
