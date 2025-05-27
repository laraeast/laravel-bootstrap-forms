<?php

namespace Laraeast\LaravelBootstrapForms\Traits;

use Laraeast\LaravelLocales\Enums\Language;
use Laraeast\LaravelLocales\Facades\Locales;

trait LocalizableComponent
{
    protected Language|null $locale = null;

    /**
     * Determine if the label will be translated or not.
     */
    protected bool $transformLabel = true;

    /**
     * Add the given lang to the name attribute.
     */
    public function locale(Language|string|null $locale = null): self
    {
        $this->locale = $locale ? Locales::from($locale) : null;

        $this->setDefaultLabel();

        return $this;
    }

    public function transformLabel(bool $transformLabel): self
    {
        $this->transformLabel = $transformLabel;

        return $this;
    }

    /**
     * Transform the properties to be used in view.
     */
    protected function transformProperties(array $properties): array
    {
        $locale = optional($this->locale);

        $nameHasBrackets = $this->nameHasBrackets;

        if ($locale->getCode()) {
            $properties['nameWithoutBrackets'] = "{$this->nameWithoutBrackets}:{$this->locale->getCode()}";

            if ($nameHasBrackets) {
                $properties['name'] = "{$this->nameWithoutBrackets}:{$this->locale->getCode()}[]";
            } else {
                $properties['name'] = "{$this->nameWithoutBrackets}:{$this->locale->getCode()}";
            }
        }

        if ($this->transformLabel && $locale->name) {
            $properties = array_merge($properties, [
                'label' => "{$this->label} ({$this->locale->native})",
            ]);
        }

        return $properties;
    }
}