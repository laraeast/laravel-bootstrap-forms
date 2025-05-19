<?php

namespace Laraeast\LaravelBootstrapForms\Traits;

trait LocalizableComponent
{
    protected \stdClass|array|null $locale = null;

    /**
     * Determine if the label will be translated or not.
     */
    protected bool $transformLabel = true;

    /**
     * Add the given lang to the name attribute.
     */
    public function locale(\stdClass|array|null $locale = null): self
    {
        $this->locale = $locale;

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

        if ($locale->code) {
            $properties['nameWithoutBrackets'] = "{$this->nameWithoutBrackets}:{$this->locale->code}";

            if ($nameHasBrackets) {
                $properties['name'] = "{$this->nameWithoutBrackets}:{$this->locale->code}[]";
            } else {
                $properties['name'] = "{$this->nameWithoutBrackets}:{$this->locale->code}";
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