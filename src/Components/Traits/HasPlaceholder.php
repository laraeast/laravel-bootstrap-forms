<?php

namespace Laraeast\LaravelBootstrapForms\Components\Traits;

trait HasPlaceholder
{
    public function placeholder(string $placeholder): self
    {
        $this->attributes['placeholder'] = $placeholder;

        return $this;
    }
}