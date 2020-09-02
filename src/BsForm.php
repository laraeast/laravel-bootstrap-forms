<?php

namespace Laraeast\LaravelBootstrapForms;

use Laraeast\LaravelLocales\Facades\Locales;
use Illuminate\Support\Str;
use Collective\Html\FormBuilder;
use Laraeast\LaravelBootstrapForms\Traits\HasOpenAndClose;
use Laraeast\LaravelBootstrapForms\Components\FileComponent;
use Laraeast\LaravelBootstrapForms\Components\TextComponent;
use Laraeast\LaravelBootstrapForms\Components\TimeComponent;
use Laraeast\LaravelBootstrapForms\Components\DateComponent;
use Laraeast\LaravelBootstrapForms\Components\EmailComponent;
use Laraeast\LaravelBootstrapForms\Components\RadioComponent;
use Laraeast\LaravelBootstrapForms\Components\NumberComponent;
use Laraeast\LaravelBootstrapForms\Components\SelectComponent;
use Laraeast\LaravelBootstrapForms\Components\SubmitComponent;
use Laraeast\LaravelBootstrapForms\Components\PasswordComponent;
use Laraeast\LaravelBootstrapForms\Components\CheckboxComponent;
use Laraeast\LaravelBootstrapForms\Components\TextareaComponent;
use Laraeast\LaravelBootstrapForms\Contracts\Components\LocalizableComponent;

class BsForm
{
    use HasOpenAndClose;

    private $resource;

    /**
     * @var array|null
     */
    protected $locale;

    /**
     * @var array
     */
    protected $locales = [];

    /**
     * The component style.
     *
     * @var string
     */
    protected $style;

    /**
     * Show inline validation errors.
     *
     * @var bool
     */
    protected $inlineValidation = true;

    /**
     * @var array
     */
    protected $components = [
        'text' => TextComponent::class,
        'textarea' => TextareaComponent::class,
        'password' => PasswordComponent::class,
        'submit' => SubmitComponent::class,
        'email' => EmailComponent::class,
        'number' => NumberComponent::class,
        'select' => SelectComponent::class,
        'date' => DateComponent::class,
        'time' => TimeComponent::class,
        'checkbox' => CheckboxComponent::class,
        'radio' => RadioComponent::class,
        'file' => FileComponent::class,
    ];

    /**
     * @var
     */
    protected static $instance;

    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'default';

    /**
     * BsForm constructor.
     */
    private function __construct()
    {
        $this->locales = Locales::get();
    }

    /**
     * @param $name
     * @param $component
     */
    public function registerComponent($name, $component)
    {
        $this->components[$name] = $component;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (isset($this->components[$name])) {
            $instance = (new $this->components[$name]($this->resource))
                ->errorBag($this->errorBag);

            if ($instance instanceof LocalizableComponent) {
                $instance->locale($this->locale);

                if ($this->locale) {
                    $instance->transformLabel(false);
                }
            }

            if ($this->style) {
                $instance->style($this->style);
            }

            $instance->inlineValidation($this->inlineValidation);

            return $instance->init(...$arguments);
        }
        if (in_array($name, $this->getFormBuilderMethods())) {
            return app('form')->{$name}(...$arguments);
        }

        $className = __CLASS__;
        throw new MethodNotFoundException("method {$name} not found in {$className}!", $name, $className);
    }

    /**
     * Set the default locale code.
     *
     * @param array|null $locale
     * @return $this
     */
    public function locale($locale = null)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @param $resource
     * @return $this
     */
    public function resource($resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * The key to be used for the view error bag.
     *
     * @param  string  $bag
     * @return $this
     */
    public function errorBag($bag = 'default')
    {
        $this->errorBag = $bag;

        return $this;
    }

    /**
     * Set the components style.
     *
     * @param $style
     * @return $this
     */
    public function style($style = null)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Clear the components style.
     *
     * @return $this
     */
    public function clearStyle()
    {
        $this->style();

        return $this;
    }

    /**
     * Set the input inline validation errors option.
     *
     * @param  bool  $bool
     * @return $this
     */
    public function inlineValidation($bool = true)
    {
        $this->inlineValidation = $bool;

        return $this;
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getFormBuilderMethods()
    {
        $class = new \ReflectionClass(FormBuilder::class);
        $methods = $class->getMethods(\ReflectionMethod::IS_PUBLIC);
        $methodsList = [];
        foreach ($methods as $method) {
            if (! Str::startsWith($method->getName(), '__')) {
                $methodsList[] = $method->getName();
            }
        }

        return $methodsList;
    }

    /**
     * @return static
     */
    public static function getInstance()
    {
        if ($instance = static::$instance) {
            return $instance;
        }

        return static::$instance = new static();
    }

    /**
     * @return array
     */
    public function getLocales()
    {
        return $this->locales;
    }

    private function __clone()
    {
        //
    }
}
