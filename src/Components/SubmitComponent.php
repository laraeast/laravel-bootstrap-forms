<?php

namespace Laraeast\LaravelBootstrapForms\Components;

class SubmitComponent extends BaseComponent
{
    /**
     * The component view path.
     *
     * @var string
     */
    protected $viewPath = 'submit';

    /**
     * The button class name.
     *
     * @var string
     */
    protected $className = 'btn-danger';

    /**
     * Initialized the input arguments.
     *
     * @param mixed ...$arguments
     * @return $this
     */
    public function init(...$arguments)
    {
        $this->name($arguments[1] ?? null);
        $this->label($arguments[0] ?? null);

        return $this;
    }

    /**
     * Set primary style for the button.
     *
     * @return $this
     */
    public function primary()
    {
        $this->className = 'btn-primary';

        return $this;
    }

    /**
     * Set danger style for the button.
     *
     * @return $this
     */
    public function danger()
    {
        $this->className = 'btn-danger';

        return $this;
    }

    /**
     * Set info style for the button.
     *
     * @return $this
     */
    public function info()
    {
        $this->className = 'btn-info';

        return $this;
    }

    /**
     * Set success style for the button.
     *
     * @return $this
     */
    public function success()
    {
        $this->className = 'btn-success';

        return $this;
    }

    /**
     * Set warning style for the button.
     *
     * @return $this
     */
    public function warning()
    {
        $this->className = 'btn-warning';

        return $this;
    }

    /**
     * The variables with registerd in view component.
     *
     * @return array
     */
    protected function viewComposer()
    {
        return [
            'className' => $this->className,
        ];
    }
}
