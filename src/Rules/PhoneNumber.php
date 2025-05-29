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
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $supportedCountries = config('laravel-bootstrap-forms.phone.countries', []);

        $supportedCountries = array_map(fn (Country $country) => $country->getCode(), $supportedCountries);

        if (Validator::make([
            "{$attribute}_country" => request("{$attribute}_country"),
        ], [
            "{$attribute}_country" => [Rule::enum(Country::class), Rule::in($supportedCountries)],
        ])->fails()) {
            $fail(__('BsForm::validation.country_not_configured'));
        }

        if (Validator::make([
            $attribute => $value,
        ], [
            $attribute => [(new Phone($value))->country(request("{$attribute}_country"))],
        ]
        )->fails()) {
            $fail(__('BsForm::validation.invalid'));
        }
    }
}
