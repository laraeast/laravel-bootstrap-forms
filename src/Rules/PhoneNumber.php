<?php

namespace Laraeast\LaravelBootstrapForms\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laraeast\LaravelBootstrapForms\Enums\Country;
use Propaganistas\LaravelPhone\Rules\Phone;

class PhoneNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $supportedCountries = $this->getSupportedCountryCodes();
        $countryInput = request("{$attribute}_country");

        if ($countryInput) {
            if (! $this->isValidCountry($attribute, $countryInput, $supportedCountries)) {
                $fail(__('BsForm::validation.country_not_configured'));

                return;
            }
            if (! $this->isValidPhone($attribute, $value, $countryInput)) {
                $fail(__('BsForm::validation.invalid'));

                return;
            }

            return;
        }

        if (! $this->isValidPhone($attribute, $value, $supportedCountries, true)) {
            $fail(__('BsForm::validation.invalid'));
        }
    }

    private function getSupportedCountryCodes(): array
    {
        $countries = config('laravel-bootstrap-forms.phone.countries', []);

        return array_map(fn (Country $country) => $country->getCode(), $countries);
    }

    private function isValidCountry(string $attribute, string $countryInput, array $supportedCountries): bool
    {
        $validator = Validator::make([
            "{$attribute}_country" => $countryInput,
        ], [
            "{$attribute}_country" => [Rule::enum(Country::class), Rule::in($supportedCountries)],
        ]);

        return ! $validator->fails();
    }

    private function isValidPhone(string $attribute, mixed $value, $country, bool $international = false): bool
    {
        $rule = new Phone($value);
        if ($international) {
            $rule->international();
        }
        $rule->country($country);
        $validator = Validator::make([
            $attribute => $value,
        ], [
            $attribute => [$rule],
        ]);

        return ! $validator->fails();
    }
}
