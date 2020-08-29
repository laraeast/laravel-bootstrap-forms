<?php

namespace Laraeast\LaravelBootstrapForms\Contracts\Components;

interface LocalizableComponent
{
    /**
     * Add the given lang to the name attribute.
     *
     * @param array|null $locale
     * @return $this
     */
    public function locale($locale = null);
}