<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Support\Htmlable;

abstract class BaseComponent implements Htmlable
{
    /**
     * The form resource name.
     *
     * @var string
     */
    protected $resource;

    /**
     * The input's name attribute.
     *
     * @var string
     */
    protected $name;

    /**
     * The input's name attribute.
     *
     * @var string
     */
    protected $nameWithoutBrackets;

    /**
     * The input's name attribute.
     *
     * @var string
     */
    protected $nameHasBrackets = false;

    /**
     * The input's value attribute.
     *
     * @var string
     */
    protected $value;

    /**
     * The input's label attribute.
     *
     * @var string
     */
    protected $label;

    /**
     * The component view path.
     *
     * @var string
     */
    protected $viewPath;

    /**
     * The input's help-block note.
     *
     * @var string
     */
    protected $note;

    /**
     * The input's attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * The select's options array.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The component style.
     *
     * @var string
     */
    protected $style = 'default';

    /**
     * Show inline validation errors.
     *
     * @var bool
     */
    protected $inlineValidation = true;

    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'default';

    /**
     * Set resource name property.
     *
     * @param $resource
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    /**
     * Initialized the input arguments.
     *
     * @param mixed ...$arguments
     * @return $this
     */
    abstract public function init(...$arguments);

    /**
     * Set the default label for the input.
     *
     * @return void
     */
    protected function setDefaultLabel()
    {
        $name = $this->nameWithoutBracketsAndLocaleForm();

        if (Lang::has($trans = "{$this->resource}.attributes.$name")) {
            $this->label = Lang::get($trans);
        }
    }

    /**
     * Set the default localed note (help-block) for the input.
     *
     * @return void
     */
    protected function setDefaultNote()
    {
        $name = $this->nameWithoutBracketsAndLocaleForm();

        if (Lang::has($trans = "{$this->resource}.notes.$name")) {
            $this->note = Lang::get($trans);
        }
    }

    /**
     * Set the default localed placeholder for the input.
     *
     * @return void
     */
    protected function setDefaultPlaceholder()
    {
        $name = $this->nameWithoutBracketsAndLocaleForm();

        if (Lang::has($trans = "{$this->resource}.placeholders.$name")) {
            $this->attributes['placeholder'] = Lang::get($trans);
        }
    }

    /**
     * @param $name
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;
        $this->nameWithoutBrackets = str_replace('[]', '', $name);

        $this->nameHasBrackets = $this->name != $this->nameWithoutBrackets;

        return $this;
    }

    /**
     * The key to be used for the view error bag.
     *
     * @param string $bag
     * @return $this
     */
    public function errorBag($bag = 'default')
    {
        $this->errorBag = $bag;

        return $this;
    }

    /**
     * @param $label
     * @return $this
     */
    public function label($label = null)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return mixed
     */
    protected function nameWithoutBracketsAndLocaleForm()
    {
        return preg_replace('/([a-zA-Z0-9]+)(:.*)?(\[(?:.*)\])?/', "$1", $this->name);
    }

    /**
     * @param $value
     * @return $this
     */
    public function value($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param $required
     * @return $this
     */
    public function required($required = true)
    {
        if ($required) {
            $this->attributes['required'] = 'required';
        }

        return $this;
    }

    /**
     * @param $autofocus
     * @return $this
     */
    public function autofocus($autofocus = true)
    {
        if ($autofocus) {
            $this->attributes['autofocus'] = 'autofocus';
        }

        return $this;
    }

    /**
     * Add custom attribute.
     *
     * @param string|array $key
     * @param null $value
     * @return $this
     */
    public function attribute($key, $value = null)
    {
        if (is_array($key)) {
            $this->attributes = array_merge($this->attributes, $key);
        } else {
            $this->attributes[$key] = $value;
        }

        return $this;
    }

    /**
     * @param $note
     * @return $this
     */
    public function note($note)
    {
        $this->note = $note;

        return $this;
    }

    protected function getViewPath()
    {
        if (Str::contains($this->viewPath, '::')) {
            $alias = explode('::', $this->viewPath)[0];
            $path = explode('::', $this->viewPath)[1];

            $bootstrap = explode('::', Config::get('laravel-bootstrap-forms.views'));

            return $alias.'::'.$bootstrap[1].'.'.$path.'.'.$this->style;
        }

        return Config::get('laravel-bootstrap-forms.views').'.'.$this->viewPath.'.'.$this->style;
    }

    /**
     * Set the component style.
     *
     * @param $style
     * @return $this
     */
    public function style($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Set the input inline validation errors option.
     *
     * @param bool $bool
     * @return $this
     */
    public function inlineValidation($bool = true)
    {
        $this->inlineValidation = $bool;

        return $this;
    }

    /**
     * Render the component.
     *
     * @return string
     */
    protected function render()
    {
        $properties = array_merge([
            'label' => $this->label,
            'name' => $this->name,
            'nameWithoutBrackets' => $this->nameWithoutBrackets,
            'value' => $this->value,
            'note' => $this->note,
            'attributes' => $this->attributes,
            'inlineValidation' => $this->inlineValidation,
            'errorBag' => $this->errorBag,
        ], $this->viewComposer());

        return view($this->getViewPath())
            ->with($this->transformProperties($properties))
            ->render();
    }

    /**
     * The variables with registerd in view component.
     *
     * @return array
     */
    protected function viewComposer()
    {
        return [];
    }

    /**
     * Transform the properties to be used in view.
     *
     * @param array $properties
     * @return array
     */
    protected function transformProperties(array $properties)
    {
        return $properties;
    }

    /**
     * Get component as a string of HTML.
     *
     * @return string
     */
    public function toHtml()
    {
        return $this->render();
    }
}
