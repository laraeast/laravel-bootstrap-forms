<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Laraeast\LaravelBootstrapForms\Components\Traits\HasPlaceholder;

class SelectComponent extends BaseComponent
{
    use HasPlaceholder;

    /**
     * The component view path.
     *
     * @var string
     */
    protected $viewPath = 'select';

    /**
     * @var array
     */
    protected $options = [];

    /**
     * Initialized the input arguments.
     *
     * @param null $name
     * @param null $value
     * @return $this
     */
    public function init($name = null, $options = [], $value = null)
    {
        $this->name($name);

        $this->value($value ?: old($name) ?: request($name));

        $this->options = $options;

        $this->setDefaultLabel($name);

        $this->setDefaultNote($name);

        $this->setDefaultPlaceholder($name);

        return $this;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function options($options = [])
    {
        $this->options = $options;

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

    /**
     * The variables with registerd in view component.
     *
     * @return array
     */
    protected function viewComposer()
    {
        return [
            'options' => $this->options,
        ];
    }
}