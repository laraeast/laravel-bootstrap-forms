<?php

namespace Laraeast\LaravelBootstrapForms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class BsForm
 * @method static \Laraeast\LaravelBootstrapForms\Components\TextComponent text($name = null, $value = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\EmailComponent email($name = null, $value = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\PasswordComponent password($name = null, $value = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\TextareaComponent textarea($name = null, $value = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\CheckboxComponent checkbox($name = null, $value = null, $checked = false)
 * @method static \Laraeast\LaravelBootstrapForms\Components\RadioComponent radio($name = null, $value = null, $checked = false)
 * @method static \Laraeast\LaravelBootstrapForms\Components\DateComponent date($name = null, $value = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\FileComponent file($name = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\NumberComponent number($name = null, $value = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\SelectComponent select($name = null, $options = [], $value = null)
 * @method static \Laraeast\LaravelBootstrapForms\Components\SubmitComponent submit($label = null, $name = null)
 * @method static  \Laraeast\LaravelBootstrapForms\BsForm open($url, $attributes = [])
 * @method static  \Laraeast\LaravelBootstrapForms\BsForm resource($resource)
 * @method static  array|null locale($locale = null)
 * @method static  \Laraeast\LaravelBootstrapForms\BsForm style($style = null)
 * @method static  \Laraeast\LaravelBootstrapForms\BsForm clearStyle()
 * @method static  \Laraeast\LaravelBootstrapForms\BsForm inlineValidation($bool = true)
 * @method static  \Laraeast\LaravelBootstrapForms\BsForm errorBag($bag = 'default')
 * @method static  \Illuminate\Support\HtmlString close()
 *
 * @package Laraeast\LaravelBootstrapForms\Facades
 */
class BsForm extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrap.form';
    }
}
