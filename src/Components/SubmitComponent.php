<?php

namespace Laraeast\LaravelBootstrapForms\Components;

class SubmitComponent extends BaseComponent
{
    /**
     * The component view path.
     */
    protected string $viewPath = 'submit';

    /**
     * The button class name.
     */
    protected string $className = 'btn-danger';

    /**
     * Initialized the input arguments.
     */
    public function init(...$arguments): self
    {
        $this->value($arguments[2] ?? '');
        $this->name($arguments[1] ?? '');
        $this->label($arguments[0] ?? '');

        return $this;
    }

    /**
     * Set primary style for the button.
     */
    public function primary(): self
    {
        $this->className = 'btn-primary';

        return $this;
    }

    /**
     * Set danger style for the button.
     */
    public function danger(): self
    {
        $this->className = 'btn-danger';

        return $this;
    }

    /**
     * Set info style for the button.
     */
    public function info(): self
    {
        $this->className = 'btn-info';

        return $this;
    }

    /**
     * Set success style for the button.
     */
    public function success(): self
    {
        $this->className = 'btn-success';

        return $this;
    }

    /**
     * Set warning style for the button.
     */
    public function warning(): self
    {
        $this->className = 'btn-warning';

        return $this;
    }

    /**
     * Set given style for the button.
     */
    public function color(string $color): self
    {
        $this->className = "btn-{$color}";

        return $this;
    }

    /**
     * The registered variables in view component.
     */
    protected function viewComposer(): array
    {
        return [
            'className' => $this->className,
        ];
    }
}
