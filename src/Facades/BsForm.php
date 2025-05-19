<?php

namespace Laraeast\LaravelBootstrapForms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class BsForm
 * @method static \Laraeast\LaravelBootstrapForms\Components\TextComponent text(?string $name = null, mixed $value = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\EmailComponent email(?string $name = null, mixed $value = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\PasswordComponent password(?string $name = null, mixed $value = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\TextareaComponent textarea(?string $name = null, mixed $value = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\CheckboxComponent checkbox(?string $name = null, mixed $value = null, bool $checked = false)
 * @method static \Laraeast\LaravelBootstrapForms\Components\RadioComponent radio(?string $name = null, mixed $value = null, bool $checked = false)
 * @method static \Laraeast\LaravelBootstrapForms\Components\DateComponent date(?string $name = null, mixed $value = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\TimeComponent time(?string $name = null, mixed $value = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\FileComponent file(?string $name = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\NumberComponent number(?string $name = null, mixed$value = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\SelectComponent select(?string $name = null, array $options = [], mixed $value = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\PriceComponent price(?string $name = null, mixed $value = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\SubmitComponent submit(?string $label = null, ?string $name = null, mixed $value = null)
 * @method static  \Laraeast\LaravelBootstrapForms\BsForm|self open(string $url, array $attributes = [])
 * @method static  \Laraeast\LaravelBootstrapForms\BsForm|self resource(string $resource)
 * @method static  array|null locale(?string $locale = null)
 * @method static  \Laraeast\LaravelBootstrapForms\BsForm|self style(?string $style = null)
 * @method static  \Laraeast\LaravelBootstrapForms\BsForm|self clearStyle()
 * @method static  \Laraeast\LaravelBootstrapForms\BsForm|self inlineValidation(bool $bool = true)
 * @method static  \Laraeast\LaravelBootstrapForms\BsForm|self errorBag(string $bag = 'default')
 * @method static  \Illuminate\Support\HtmlString close()
 *
 * @package Laraeast\LaravelBootstrapForms\Facades
 */
class BsForm extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'bootstrap.form';
    }
}
