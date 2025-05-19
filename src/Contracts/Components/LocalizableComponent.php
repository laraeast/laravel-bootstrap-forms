<?php

namespace Laraeast\LaravelBootstrapForms\Contracts\Components;

interface LocalizableComponent
{
    /**
     * Add the given lang to the name attribute.
     */
    public function locale(\stdClass|array|null $locale = null): self;
}