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
     * @param null $name
     * @param null $value
     * @param bool $checked
     * @return $this
     */
    public function init($name = null, $value = null, $checked = false)
    {
        $this->name($name);

        $this->value($value ?: old($name));

        $this->checked = $checked;

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