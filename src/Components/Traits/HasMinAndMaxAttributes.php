<?php

namespace Laraeast\LaravelBootstrapForms\Components\Traits;

trait HasMinAndMaxAttributes
{
    /**
     * @param $max
     * @return $this
     */
    public function max($max)
    {
        $this->attributes['max'] = $max;

        return $this;
    }

    /**
     * @param $min
     * @return $this
     */
    public function min($min)
    {
        $this->attributes['min'] = $min;

        return $this;
    }

    /**
     * @param $step
     * @return $this
     */
    public function step($step)
    {
        $this->attributes['step'] = $step;

        return $this;
    }
}