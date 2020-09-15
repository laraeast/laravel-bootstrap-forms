<?php

namespace Laraeast\LaravelBootstrapForms\Components;

class RadioComponent extends BaseComponent
{
    /**
     * The component view path.
     *
     * @var string
     */
    protected $viewPath = 'radio';

    /**
     * @var bool
     */
    protected $checked = false;

    /**
     * Initialized the input arguments.
     *
     * @param mixed ...$arguments
     * @return $this
     */
    public function init(...$arguments)
    {
        $this->name($name = $arguments[0] ?? null);

        $this->value($arguments[1] ?? null ?: old($name));

        $this->checked = $arguments[2] ?? false;

        $this->setDefaultLabel($name);

        $this->setDefaultNote($name);

        $this->setDefaultPlaceholder($name);

        return $this;
    }

    /**
     * @param bool $checked
     * @return $this
     */
    public function checked($checked = true)
    {
        $this->checked = ! ! $checked;

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
            'checked' => $this->checked,
        ];
    }
}
