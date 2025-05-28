<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Laraeast\LaravelBootstrapForms\Enums\Country;

class PhoneComponent extends TextualComponent
{
    /**
     * The component view path.
     */
    protected string $viewPath = 'phone';

    protected array $countries = [];

    public function init(...$arguments): self
    {
        $this->name($name = $arguments[0] ?? null);

        $this->value($arguments[1] ?? null ?: old($name));

        $this->setDefaultLabel();

        $this->setDefaultNote();

        $this->setDefaultPlaceholder();

        $this->countries(config('laravel-bootstrap-forms.phone.countries'));

        return $this;
    }

    public function countries(array $countries): self
    {
        $this->countries = array_map(
            fn ($country) => $country instanceof Country ? $country : Country::tryFrom($country),
            $countries
        );

        return $this;
    }

    protected function viewComposer(): array
    {
        return array_merge(parent::viewComposer(), [
            'countries' => $this->countries,
            'countriesListFormat' => config('laravel-bootstrap-forms.phone.countries_list_format'),
        ]);
    }
}
