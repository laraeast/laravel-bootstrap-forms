<?php

namespace Laraeast\LaravelBootstrapForms\Components\Traits;

trait HasMinLengthAndMaxLengthAttributes
{
    public function maxLength(int $max): self
    {
        $this->attributes['maxlength'] = $max;

        return $this;
    }

    public function minLength(int $min): self
    {
        $this->attributes['minlength'] = $min;

        return $this;
    }
}