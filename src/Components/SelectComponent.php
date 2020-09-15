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
     * @param mixed ...$arguments
     * @return $this
     */
    public function init(...$arguments)
    {
        $this->name($name = $arguments[0] ?? null);

        $this->value($arguments[2] ?? null ?: old($name) ?: request($name));

        $this->options = $arguments[1] ?? [];

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
