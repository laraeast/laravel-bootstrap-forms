<?php

namespace Laraeast\LaravelBootstrapForms\Contracts\Components;

use Laraeast\LaravelLocales\Enums\Language;

interface LocalizableComponent
{
    /**
     * Add the given lang to the name attribute.
     */
    public function locale(Language|string|null $locale = null): self;
}