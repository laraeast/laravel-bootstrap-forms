<?php

namespace Laraeast\LaravelBootstrapForms\Tests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;
use Laraeast\LaravelBootstrapForms\Facades\BsForm;
use Laraeast\LaravelBootstrapForms\Providers\BootstrapFormsServiceProvider;
use Laraeast\LaravelLocales\Providers\LocalesServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * @var \Illuminate\Routing\UrlGenerator
     */
    protected $urlGenerator;

    /**
     * @var \Illuminate\Contracts\View\Factory|\Mockery\LegacyMockInterface|\Mockery\MockInterface
     */
    protected $viewFactory;

    /**
     * @var \Illuminate\Contracts\Session\Session|\Mockery\LegacyMockInterface|\Mockery\MockInterface
     */
    protected $session;

    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $blade;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        View::share('errors', new ViewErrorBag);

        $this->app->setLocale('en');

        $this->blade = resolve('blade.compiler');

        $this->app['config']->set(['laravel-bootstrap-forms.views' => 'BsForm::bootstrap3']);
    }

    /**
     * Load package service provider.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            BootstrapFormsServiceProvider::class,
            LocalesServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'BsForm' => BsForm::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('session.driver', 'array');
    }

    /**
     * Minify html content.
     *
     * @return string|string[]|null
     */
    protected function minifyHtml($input): string|array|null
    {
        if (trim($input) === '') {
            return $input;
        }
        // Remove extra white-space(s) between HTML attribute(s)
        $input = preg_replace_callback('#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s', function ($matches) {
            return '<'.$matches[1].preg_replace('#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2',
                $matches[2]).$matches[3].'>';
        }, str_replace("\r", '', $input));

        return preg_replace(
            [
                // t = text
                // o = tag open
                // c = tag close
                // Keep important white-space(s) after self-closing HTML tag(s)
                '#<(img|input)(>| .*?>)#s',
                // Remove a line break and two or more white-space(s) between tag(s)
                '#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
                '#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s',
                // t+c || o+t
                '#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s',
                // o+o || c+c
                '#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s',
                // c+t || t+o || o+t -- separated by long white-space(s)
                '#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s',
                // empty tag
                '#<(img|input)(>| .*?>)<\/\1>#s',
                // reset previous fix
                '#(&nbsp;)&nbsp;(?![<\s])#',
                // clean up ...
                '#(?<=\>)(&nbsp;)(?=\<)#',
                // --ibid
                // Remove HTML comment(s) except IE comment(s)
                '#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s',
            ],
            [
                '<$1$2</$1>',
                '$1$2$3',
                '$1$2$3',
                '$1$2$3$4$5',
                '$1$2$3$4$5$6$7',
                '$1$2$3',
                '<$1$2',
                '$1 ',
                '$1',
                '',
            ],
            $input);
    }
}
