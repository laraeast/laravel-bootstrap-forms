<?php

namespace Laraeast\LaravelBootstrapForms;

use Laraeast\LaravelLocales\Facades\Locales;
use Laraeast\LaravelBootstrapForms\Traits\HasOpenAndClose;
use Laraeast\LaravelBootstrapForms\Components\FileComponent;
use Laraeast\LaravelBootstrapForms\Components\TextComponent;
use Laraeast\LaravelBootstrapForms\Components\TimeComponent;
use Laraeast\LaravelBootstrapForms\Components\DateComponent;
use Laraeast\LaravelBootstrapForms\Components\ColorComponent;
use Laraeast\LaravelBootstrapForms\Components\EmailComponent;
use Laraeast\LaravelBootstrapForms\Components\PriceComponent;
use Laraeast\LaravelBootstrapForms\Components\RadioComponent;
use Laraeast\LaravelBootstrapForms\Components\NumberComponent;
use Laraeast\LaravelBootstrapForms\Components\SelectComponent;
use Laraeast\LaravelBootstrapForms\Components\SubmitComponent;
use Laraeast\LaravelBootstrapForms\Components\PasswordComponent;
use Laraeast\LaravelBootstrapForms\Components\CheckboxComponent;
use Laraeast\LaravelBootstrapForms\Components\TextareaComponent;
use Laraeast\LaravelBootstrapForms\Contracts\Components\LocalizableComponent;
use Spatie\Html\Elements\Form;

class BsForm
{
    use HasOpenAndClose;

    private string $resource = '';

    protected array $locales = [];

    protected \stdClass|array|null $locale = null;

    /**
     * The component style.
     */
    protected string $style = 'default';

    /**
     * Show inline validation errors.
     */
    protected bool $inlineValidation = true;

    protected array $components = [
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
        'price' => PriceComponent::class,
        'color' => ColorComponent::class,
    ];

    protected static ?self $instance = null;

    /**
     * The key to be used for the view error bag.
     */
    protected string $errorBag = 'default';

    /**
     * BsForm constructor.
     */
    private function __construct()
    {
        $this->locales = Locales::get();
    }

    public function registerComponent(string $name, string $component): void
    {
        $this->components[$name] = $component;
    }

    public function __call(string $name, array $arguments): mixed
    {
        if (isset($this->components[$name])) {
            $instance = (new $this->components[$name]($this->resource))
                ->errorBag($this->errorBag);

            $instance->name($name);

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

        $className = __CLASS__;
        throw new \Exception("method {$name} not found in {$className}!", $name, $className);
    }

    /**
     * Set the default locale code.
     */
    public function locale(\stdClass|array|null $locale = null): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function resource(string $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * The key to be used for the view error bag.
     */
    public function errorBag(string $bag = 'default'): self
    {
        $this->errorBag = $bag;

        return $this;
    }

    /**
     * Set the components style.
     */
    public function style(?string $style = null): self
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Clear the components style.
     */
    public function clearStyle(): self
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
    public function inlineValidation(bool $bool = true): self
    {
        $this->inlineValidation = $bool;

        return $this;
    }

    public static function getInstance(): self
    {
        if ($instance = static::$instance) {
            return $instance;
        }

        return static::$instance = new static();
    }

    /**
     * @return array
     */
    public function getLocales(): array
    {
        return $this->locales;
    }

    private function __clone()
    {
        //
    }
}
