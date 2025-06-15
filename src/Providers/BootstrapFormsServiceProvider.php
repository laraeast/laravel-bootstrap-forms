<?php

namespace Laraeast\LaravelBootstrapForms\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Laraeast\LaravelBootstrapForms\BsForm;
use Laraeast\LaravelBootstrapForms\Helpers\FormDirectives;
use Laraeast\LaravelBootstrapForms\Rules\PhoneNumber;

class BootstrapFormsServiceProvider extends ServiceProvider
{
    /**
     * BsForm any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom($this->srcPath('views'), 'BsForm');

        $this->publishes([
            $this->srcPath('config/laravel-bootstrap-forms.php') => config_path('laravel-bootstrap-forms.php'),
        ], 'laravel-bootstrap-forms.config');

        $this->publishes([
            $this->srcPath('views') => resource_path('views/vendor/BsForm'),
        ], 'laravel-bootstrap-forms.views');

        $this->publishes([
            $this->srcPath('lang') => lang_path('vendor/BsForm'),
        ], 'laravel-bootstrap-forms.lang');

        $this->loadTranslationsFrom($this->srcPath('lang'), 'BsForm');

        FormDirectives::register();

        if ($this->app->runningInConsole() || $this->app->runningUnitTests()) {
            $this->loadTranslationsFrom(__DIR__.'/../../tests/resources/lang', 'test');
            $this->loadViewsFrom(__DIR__.'/../../tests/resources/views', 'test');
        }

        Request::macro('phone', function ($phone) {
            $phoneNumber = (string) $this->input($phone);
            $country = $this->input("{$phone}_country");

            if (Validator::make(['phone' => $phoneNumber], [new PhoneNumber])->fails()) {
                return null;
            }

            if (! phone($phoneNumber, $country)->isValid()) {
                return null;
            }

            return phone($phoneNumber, $country)->formatE164();
        });

        Request::macro('allWithPhoneNumber', function ($phone) {
            $data = Arr::except($this->all(), "{$phone}_country");

            $data[$phone] = $this->phone($phone);

            return $data;
        });

        Request::macro('validatedWithPhoneNumber', function ($phone) {
            $data = Arr::except($this->validated(), "{$phone}_country");

            if (isset($data[$phone])) {
                $data[$phone] = $this->phone($phone);
            }

            return $data;
        });
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('bootstrap.form', function () {
            return BsForm::getInstance();
        });

        $this->mergeConfigFrom(
            $this->srcPath('config/laravel-bootstrap-forms.php'), 'laravel-bootstrap-forms'
        );
    }

    private function srcPath(string $path): string
    {
        return __DIR__.'/../'.$path;
    }
}
