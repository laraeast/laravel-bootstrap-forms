<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

abstract class BaseComponent implements Htmlable
{
    /**
     * The input's name attribute.
     */
    protected string $name = '';

    /**
     * The input's name attribute without brackets.
     */
    protected string $nameWithoutBrackets = '';

    /**
     * Determine if the input's name attribute has brackets.
     */
    protected bool $nameHasBrackets = false;

    /**
     * The input's value attribute.
     */
    protected mixed $value = '';

    /**
     * The input's label attribute.
     */
    protected string $label = '';

    /**
     * The component view path.
     */
    protected string $viewPath;

    /**
     * The input's help-block note.
     */
    protected string $note = '';

    /**
     * The input's attributes.
     */
    protected array $attributes = [];

    /**
     * The select's options array.
     */
    protected array $options = [];

    /**
     * The component style.
     */
    protected string $style = 'default';

    /**
     * Show inline validation errors.
     */
    protected bool $inlineValidation = true;

    /**
     * The key to be used for the view error bag.
     */
    protected string $errorBag = 'default';

    /**
     * Set resource name property.
     */
    public function __construct(
        protected string $resource,
    ) {}

    /**
     * Initialized the input arguments.
     */
    abstract public function init(...$arguments): self;

    /**
     * Set the default label for the input.
     */
    protected function setDefaultLabel(): void
    {
        $name = $this->nameWithoutBracketsAndLocaleForm();

        if (Lang::has($trans = "{$this->resource}.attributes.$name")) {
            $this->label = Lang::get($trans);
        }
    }

    /**
     * Set the default localed note (help-block) for the input.
     */
    protected function setDefaultNote(): void
    {
        $name = $this->nameWithoutBracketsAndLocaleForm();

        if (Lang::has($trans = "{$this->resource}.notes.$name")) {
            $this->note = Lang::get($trans);
        }
    }

    /**
     * Set the default localed placeholder for the input.
     */
    protected function setDefaultPlaceholder(): void
    {
        $name = $this->nameWithoutBracketsAndLocaleForm();

        if (Lang::has($trans = "{$this->resource}.placeholders.$name")) {
            $this->attributes['placeholder'] = Lang::get($trans);
        }
    }

    public function name(string $name): self
    {
        $this->name = $name;
        $this->nameWithoutBrackets = str_replace('[]', '', $name);

        $this->nameHasBrackets = $this->name != $this->nameWithoutBrackets;

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

    public function label(?string $label = null): self
    {
        $this->label = $label;

        return $this;
    }

    protected function nameWithoutBracketsAndLocaleForm(): string
    {
        return preg_replace('/([a-zA-Z0-9]+)(:.*)?(\[(?:.*)\])?/', '$1', $this->name);
    }

    public function value(mixed $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function required(bool $required = true): self
    {
        if ($required) {
            $this->attributes['required'] = 'required';
        }

        return $this;
    }

    public function autofocus(bool $autofocus = true): self
    {
        if ($autofocus) {
            $this->attributes['autofocus'] = 'autofocus';
        }

        return $this;
    }

    /**
     * Add custom attribute.
     */
    public function attribute(string|array $key, mixed $value = null): self
    {
        if (is_array($key)) {
            $this->attributes = array_merge($this->attributes, $key);
        } else {
            $this->attributes[$key] = $value;
        }

        return $this;
    }

    public function note(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    protected function getViewPath(): string
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
     * Set the default component style.
     */
    public function setDefaultStyle(): self
    {
        if ($defaultStyle = Config::get('laravel-bootstrap-forms.default_style')) {
            $this->style = $defaultStyle;
        }

        return $this;
    }

    /**
     * Set the component style.
     */
    public function style(string $style): self
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Set the input inline validation errors option.
     */
    public function inlineValidation(bool $bool = true): self
    {
        $this->inlineValidation = $bool;

        return $this;
    }

    /**
     * Render the component.
     */
    protected function render(): string
    {
        $this->beforeRender();

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

    protected function beforeRender(): void
    {
        //
    }

    /**
     * The registered variables in view component.
     */
    protected function viewComposer(): array
    {
        return [];
    }

    /**
     * Transform the properties to be used in view.
     */
    protected function transformProperties(array $properties): array
    {
        return $properties;
    }

    /**
     * Get component as a string of HTML.
     */
    public function toHtml(): string
    {
        return $this->render();
    }
}
