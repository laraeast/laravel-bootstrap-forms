<?php

namespace Laraeast\LaravelBootstrapForms\Components\Traits;

trait HasMinLengthAndMaxLengthAttributes
{
    /**
     * @param $max
     * @return $this
     */
    public function maxLength($max)
    {
        $this->attributes['maxlength'] = $max;

        return $this;
    }

    /**
     * @param $min
     * @return $this
     */
    public function minLength($min)
    {
        $this->attributes['minlength'] = $min;

        return $this;
    }
}