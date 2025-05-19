<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Illuminate\Support\Facades\Lang;

class PriceComponent extends TextualComponent
{
    /**
     * The component view path.
     */
    protected string $viewPath = 'price';

    protected string $currency = '';
    protected string|float $step = 0.01;
    protected string $placeholder = '0.00';

    public function init(...$arguments): TextualComponent
    {
        $this->name($name = $arguments[0] ?? null);

        $this->value($arguments[1] ?? null ?: old($name));

        $this->setDefaultLabel();

        $this->setDefaultNote();

        $this->setDefaultPlaceholder();

        return $this;
    }

    /**
     * Set the default localed placeholder for the input.
     */
    protected function setDefaultPlaceholder(): void
    {
        $name = $this->nameWithoutBracketsAndLocaleForm();

        if (Lang::has($trans = "{$this->resource}.placeholders.$name")) {
            $this->attributes['placeholder'] = Lang::get($trans);
        } else {
            $this->attributes['placeholder'] = $this->placeholder;
        }
    }

    public function currency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function step(string|float $step): self
    {
        $this->step = $step;

        return $this;
    }

    protected function viewComposer(): array
    {
        return array_merge_recursive(parent::viewComposer(), [
            'currency' => $this->currency,
            'step' => $this->step,
        ]);
    }
}