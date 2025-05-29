<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Laraeast\LaravelBootstrapForms\Enums\Country;
use Laraeast\LaravelBootstrapForms\Exceptions\CountryNotConfiguredException;

class PhoneComponent extends TextualComponent
{
    /**
     * The component view path.
     */
    protected string $viewPath = 'phone';

    protected array $countries = [];

    protected ?Country $selectedCountry = null;

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

    protected function beforeRender(): void
    {
        $value = (string) $this->value;
        $this->selectedCountry = Country::tryFrom(
            phone($value)->isValid() && phone($value)->getCountry()
                ? phone($value)->getCountry()
                : old("{$this->name}_country", (isset($this->countries[0]) ? $this->countries[0]->getCode() : null))
        );

        if (empty($this->countries)) {
            throw new CountryNotConfiguredException('There is no countries configured.');
        }

        if ($this->selectedCountry && ! in_array($this->selectedCountry, $this->countries)) {
            throw new CountryNotConfiguredException('The country of the phone number is not configured.');
        }

        if (phone($value, $this->selectedCountry->getCode())->isValid()) {
            $value = str_replace(' ', '', phone($value, $this->selectedCountry->getCode())->formatNational());

            $this->value($value);
        }
    }

    protected function viewComposer(): array
    {
        return array_merge(parent::viewComposer(), [
            'countries' => $this->countries,
            'selectedCountry' => $this->selectedCountry,
            'countriesListFormat' => config('laravel-bootstrap-forms.phone.countries_list_format'),
        ]);
    }
}
