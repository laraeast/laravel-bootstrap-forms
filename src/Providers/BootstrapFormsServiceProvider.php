<?php

namespace Laraeast\LaravelBootstrapForms\Providers;

use Illuminate\Support\ServiceProvider;
use Laraeast\LaravelBootstrapForms\BsForm;
use Laraeast\LaravelBootstrapForms\Helpers\FormDirectives;

class BootstrapFormsServiceProvider extends ServiceProvider
{
    /**
     * BsForm any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom($this->srcPath('views'), 'BsForm');

        $this->publishes([
            $this->srcPath('config/laravel-bootstrap-forms.php') => config_path('laravel-bootstrap-forms.php'),
        ], 'laravel-bootstrap-forms.config');

        $this->publishes([
            $this->srcPath('views') => resource_path('views/vendor/BsForm'),
        ], 'laravel-bootstrap-forms.views');

        FormDirectives::register();

        if ($this->app->runningInConsole() || $this->app->runningUnitTests()) {
            $this->loadTranslationsFrom(__DIR__.'/../../tests/resources/lang', 'test');
            $this->loadViewsFrom(__DIR__.'/../../tests/resources/views', 'test');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('bootstrap.form', function () {
            return BsForm::getInstance();
        });

        $this->mergeConfigFrom(
            $this->srcPath('config/laravel-bootstrap-forms.php'), 'laravel-bootstrap-forms'
        );
    }
    
    private function srcPath($path)
    {
        return __DIR__.'/../'.$path;
    }
}
