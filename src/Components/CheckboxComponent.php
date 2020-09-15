<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Illuminate\Support\Facades\Config;

class CheckboxComponent extends BaseComponent
{
    /**
     * The component view path.
     *
     * @var string
     */
    protected $viewPath = 'checkbox';

    /**
     * @var bool
     */
    protected $checked = false;

    /**
     * @var bool
     */
    protected $hasDefaultValue = true;

    /**
     * @var mixed
     */
    protected $defaultValue = 0;

    /**
     * Set resource name property.
     *
     * @param $resource
     */
    public function __construct($resource)
    {
        parent::__construct($resource);

        $this->hasDefaultValue = Config::get('laravel-bootstrap-forms.checkboxes.hasDefaultValue', true);
    }

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

        $this->setDefaultLabel();

        $this->setDefaultNote();

        $this->setDefaultPlaceholder();

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
     * @param mixed $value
     * @return $this
     */
    public function default($value = 0)
    {
        $this->hasDefaultValue = true;

        $this->defaultValue = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withoutDefault()
    {
        $this->hasDefaultValue = false;

        return $this;
    }

    /**
     * @return $this
     */
    public function withDefault()
    {
        $this->hasDefaultValue = true;

        return $this;
    }

    /**
     * The variables with registered in view component.
     *
     * @return array
     */
    protected function viewComposer()
    {
        return [
            'checked' => $this->checked,
            'hasDefaultValue' => $this->hasDefaultValue,
            'defaultValue' => $this->defaultValue,
        ];
    }
}
