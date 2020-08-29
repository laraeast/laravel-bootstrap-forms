<?php

namespace Laraeast\LaravelBootstrapForms\Components;

class FileComponent extends BaseComponent
{
    /**
     * The component view path.
     *
     * @var string
     */
    protected $viewPath = 'file';

    /**
     * Initialized the input arguments.
     *
     * @param null $name
     * @param null $value
     * @return $this
     */
    public function init($name = null)
    {
        $this->name($name);

        $this->setDefaultLabel($name);

        $this->setDefaultNote($name);

        return $this;
    }

    /**
     * @param bool $multiple
     * @return $this
     */
    public function multiple($multiple = true)
    {
        if ($multiple) {
            $this->attributes['multiple'] = 'multiple';
        }

        return $this;
    }
}