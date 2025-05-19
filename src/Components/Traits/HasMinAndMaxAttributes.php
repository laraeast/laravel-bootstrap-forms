<?php

namespace Laraeast\LaravelBootstrapForms\Components\Traits;

trait HasMinAndMaxAttributes
{
    public function max(float $max): self
    {
        $this->attributes['max'] = $max;

        return $this;
    }

    public function min(float $min): self
    {
        $this->attributes['min'] = $min;

        return $this;
    }

    public function step(float $step): self
    {
        $this->attributes['step'] = $step;

        return $this;
    }
}