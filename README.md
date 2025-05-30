# # Laravel Bootstrap Forms.
<p align="center">
<a href="https://github.com/laraeast/laravel-bootstrap-forms/actions/workflows/tests.yml"><img src="https://github.com/laraeast/laravel-bootstrap-forms/actions/workflows/tests.yml/badge.svg?branch=master" alt="Build Status"></a>
<a href="https://packagist.org/packages/laraeast/laravel-bootstrap-forms"><img src="https://poser.pugx.org/laraeast/laravel-bootstrap-forms/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laraeast/laravel-bootstrap-forms"><img src="https://poser.pugx.org/laraeast/laravel-bootstrap-forms/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laraeast/laravel-bootstrap-forms"><img src="https://poser.pugx.org/laraeast/laravel-bootstrap-forms/license.svg" alt="License"></a>
</p>

- [Installation](#installation)
- [Opening A Form](#opening-a-form)
- [Text, Text Area, Date, Number, Files, Base64Image, Color & Password Fields](#fields)
- [Price Field](#price)
- [Phone Field](#phone)
- [Checkboxes and Radio Buttons](#checkboxes)
- [Drop-Down Lists](#dropdown)
- [Generating A Submit Button](#submit)
- [Supported Methods](#methods)
- [Using Resource With Localed Fields](#resource)
- [Example Register Form](#example)
- [Add Custom Style To The Component](#custom-style)
- [Using Multilingual Form Tabs](#multilingual)
- [Manage Locales](#locales)
- [Using Bootstrap 3 or 4](#bootstrap3)
- [Add Custom Component](#custom-component)

<a name="installation"></a>
# # Installation
> Begin by installing this package through Composer. Edit your project's `composer.json` file to require `laraeast/laravel-bootstrap-forms`.
```bash
composer require laraeast/laravel-bootstrap-forms
```
<a name="opening-a-form"></a>
# # Opening A Form
```blade
{{ BsForm::open($url) }}
//
{{ BsForm::close() }}
```
> By default, a `POST` method will be assumed; however, you are free to specify another method:

```blade
{{ BsForm::open($url, ['method' => 'post']) }}
```

> Note: Since HTML forms only support `POST` and `GET`, `PUT` and `DELETE` methods will be spoofed by automatically adding a `_method` hidden field to your form.

> You may also open forms with method as well:
 ```blade
 {{ BsForm::get('foo/bar') }}
 {{ BsForm::post('foo/bar') }}
 {{ BsForm::put('foo/bar') }}
 {{ BsForm::patch('foo/bar') }}
 {{ BsForm::delete('foo/bar') }}
 {{ BsForm::model($model, 'foo/bar') }}
 {{ BsForm::putModel($model, 'foo/bar') }}
 {{ BsForm::patchModel($model, 'foo/bar') }}
 ```
> You may also open forms that point to named routes or controller actions:

```blade
{{ BsForm::open(['route' => 'route.name']) }}
{{ BsForm::open(['action' => 'Controller@method']) }}
```

>You may pass in route parameters as well:

```blade
{{ BsForm::open(['route' => ['route.name', $user->id]]) }}
{{ BsForm::open(['action' => ['Controller@method', $user->id]]) }}
```

<a name="fields"></a>
# # Text, Text Area, Date, Number & Password Fields

> Generating A Text Input

```blade
{{ BsForm::text('username') }}
```

## Specifying A Default Value

```blade
{{ BsForm::text('email', 'example@gmail.com') }}
{{ BsForm::text('email')->value('example@gmail.com') }}
```

> Note: The date, number and textarea methods have the same signature as the text method.

 ## Generating A Password Input

```blade
{{ BsForm::password('password', ['class' => 'awesome']) }}
{{ BsForm::password('password')->attr('class', 'awesome') }}
```

## Generating Other Inputs

```blade
{{ BsForm::email($name)->value($value)->label($label) }}
{{ BsForm::file($name)->label('Upload File') }}
```

## Multilingual Forms (text & textarea)

```blade
@multilingualFormTabs
    {{ BsForm::text('title')->value(old('title:'.$locale->code))->label($label) }}
@endMultilingualFormTabs
```
> The name attribute will be `name:{lang}`
> 
> The variable `$locale` is preset inside `@multilingualFormTabs` and `@endMultilingualFormTabs` and it contains the iterator of `Locales::get()` see: [Laravel Locales Package](https://github.com/laraeast/laravel-locales)

<a name="checkboxes"></a>
# # Checkboxes and Radio Buttons
## Generating A Checkbox Or Radio Input

```blade
{{ BsForm::checkbox('name', 'value')->checked(false) }}
{{ BsForm::checkbox('name')->value('value')->checked(false) }}
{{ BsForm::checkbox('name')->value(1)->withDefault()->checked(false) }} {{-- If unchecked will send "0" with request --}}
{{ BsForm::checkbox('name')->value(1)->withoutDefault()->checked(false) }}
{{ BsForm::checkbox('name')->value(1)->default('no')->checked(false) }} {{-- If unchecked will send "no" with request --}}

{{ BsForm::radio('name', 'value')->checked(false)->label('label') }}
{{ BsForm::radio('name')->value('value')->checked(false)->label('label') }}
```
> By default, will send default value "0" with an unchecked checkbox, if you want to disable it globally set the configuration key "laravel-bootstrap-forms.checkboxes.hasDefaultValue": true

<a name="dropdown"></a>
# # Drop-Down Lists

```blade
{{ BsForm::select('size', ['L' => 'Large', 'S' => 'Small']) }}
{{ BsForm::select('size')->options(['L' => 'Large', 'S' => 'Small']) }}
```

## Generating A Drop-Down List With Selected Default

```blade
{{ BsForm::select('size')->options(['L' => 'Large', 'S' => 'Small'])->value('S') }}
```

## Generating a Drop-Down List With an Empty Placeholder

```blade
{{ BsForm::select('size')->options(['L' => 'Large', 'S' => 'Small'])->placeholder('Select Size') }}
```

## Generating A Grouped List

```blade
{{ BsForm::select('animal',[
         'Cats' => ['leopard' => 'Leopard'],
         'Dogs' => ['spaniel' => 'Spaniel'],
   ]) }}
```

## File

```blade
{{ BsForm::file('attachment') }}
{{ BsForm::file('attachments')->multiple() }}
```
## Base64Image (with preview)

```blade
{{ BsForm::base64image('avatar') }}
{{ BsForm::base64image('avatar')->label('Avatar') }}
{{ BsForm::base64image('avatar')
    ->label('Avatar')
    ->uploadLabel('Upload Picture')
    ->resetLabel('Reset Picture')
    ->uploadColor('primary')
    ->resetColor('danger') }}
{{ BsForm::base64image('avatar')
    ->label('Avatar')
    ->default('/path/to/default/preview') }}
```
> Regarding upload label & reset label, you can add them into translation file for the resource in `actions.{resource_name}` array, for example if the resource name is `users` and the field name is `avatar`, You should add the following translation `lang/en/users.php`:
```php
<?php

return [
    'actions' => [
        'avatar' => [
            'upload' => 'Upload image',
            'reset' => 'Reset image',
        ],
    ],
    'notes' => [
        'avatar' => 'Allowed JPG, GIF or PNG. Max size of 800K',
    ],
    // ...
];
```

<a name="price"></a>
# # Generating A Price Field
```blade
{{ BsForm::price('amount) }}
{{ BsForm::price('amount)->currency('$') }}
{{ BsForm::price('amount)->step(.001) }}
```

<a name="phone"></a>
# # Generating A Phone Field
> Generate a phone field with country select,
```blade
{{ BsForm::phone('phone) }}
{{ BsForm::phone('phone)->countries(['SA', 'EG']) }}
```
> This will generate 2 inputs `phone` and `phone_country`. You can store both columns to database or use `E164` format.

In controller, You can use `$request->phone('phone')` to return the phone number in `E164` format so you can store it in the database.
Also, You can use `$request->allWithPhoneNumber('phone')` or `$request->validatedWithPhoneNumber('phone')` that will transform the phone number in the array with `E164` format.

**Validation:**
```php
use Laraeast\LaravelBootstrapForms\Rules\PhoneNumber;

// ...

public function rules(): array
{
    return [
        'phone' => ['required', new PhoneNumber],
    ];
}
```

**Controller:**
```php
// ...

public function update(Request $request, User $user)
{
    // Example: if you select EGYPT country and phone number is: 01098135318
    $user->phone = $request->phone('phone');
    
    // $user->phone = '+201098135318';
    
    $user->save();

    // Or
    $user->update($request->allWithPhoneNumber('phone'));

    // Or
    $user->update($request->validatedWithPhoneNumber('phone'));
    
    // ...
}
```

> You can configure countries from `laravel-bootstrap-forms`config in `phone` array:
```php
    'phone' => [
        /**
         * The list of supported countries that will be displayed in phone input.
         *
         * If you want to use all countries, You can use Country::all(),
         */
        'countries' => [
            Country::SA,
            Country::KW,
            Country::IQ,
            Country::AE,
            Country::BH,
            Country::EG,
        ],

        /**
         * The format of countries list.
         *
         * Examples:
         * "{FLAG} {COUNTRY_CODE} ({DEAL_CODE})" => "🇸🇦 SA (+966)"
         * "{FLAG} {COUNTRY_NAME} ({DEAL_CODE})" => "🇸🇦 Saudi Arabia (+966)"
         */
        'countries_list_format' => '{FLAG} {COUNTRY_CODE} ({DEAL_CODE})',
    ],
```
> Also, if you have `phone_country` column in the database, You can cast it from model to `Laraeast\LaravelBootstrapForms\Enums\Country` enum
```php
/**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'phone_country' => Country::class,
            // ...
        ];
    }
```
> **NOTE:** It is recommended to set the phone value manually when use `BsForm::model()`, `BsForm::putModel()` and `BsForm::patchModel()` to avoid any issue in input value.

```blade
{{ BsForm::putModel($user, route('users.update', $user)) }}

{{ BsForm::phone('phone', old('phone', $user->phone)) }}

{{ BsForm::close() }}
```

<a name="submit"></a>
# # Generating A Submit Button

```blade
{{ BsForm::submit('Click Me!') }}
```

## Generateing A Submit Button With Bootstrap Button Style

```blade
{{ BsForm::submit('Click Me!')->success() }}
{{ BsForm::submit('Click Me!')->primary() }}
{{ BsForm::submit('Click Me!')->info() }}
{{ BsForm::submit('Click Me!')->warning() }}
{{ BsForm::submit('Click Me!')->danger() }}
{{ BsForm::submit('Click Me!')->color('secondary') }}
{{ BsForm::submit('Click Me!')->color('outline-secondary') }}
``` 

<a name="metods"></a>
# # Supported Methods

> `->label($label) ` : To Generate label to the specified field.

```blade
{{ BsForm::text('username')->label('Username') }}
```

> `->name($name) ` : To Generate label to the specified field.

```blade
{{ BsForm::text('username')->label('Username') }}
```

> `->placeholder($placeholder) ` : To Set placeholder attribute to the specified field.

```blade
{{ BsForm::text('username')->placeholder('Please Enter Your Name') }}
```

> `->min($min)` : To Set min attribute to the specified number field.

```blade
{{ BsForm::number('age')->min(10) }}
```

> `->max($max)` : To Set max attribute to the specified number field.

```blade
{{ BsForm::number('age')->min(10)->max(30) }}
```

> `->step($step)` : To Set step attribute to the specified number field.

```blade
{{ BsForm::number('age')->min(10)->max(30)->step(1) }}
```

> `->multiple($bool = true)` : To Set multiple attribute to the specified select and file fields.

```blade
{{ BsForm::file('photos[]')->multiple() }}
```

> `->note($note)` : To Set `help-block` to the specified field.

```blade
{{ BsForm::text('username')->note('Example: Ahmed Fathy') }}
```

> `->name($name)` : To Set the name of to the specified field.

```blade
{{ BsForm::text()->name('username')->note('Example: Ahmed Fathy') }}
```

> `->value($value)` : To Set the value of to the specified field as default will set `old('name')`.

```blade
{{ BsForm::text()->name('username')->value('Ahmed Fathy') }}
```

> `->inlineValidation($bool = true)` : To display validation errors in the specified field.

```blade
{{ BsForm::text('username')->style('horizontal')->inlineValidation(false) }}
```

> `->style($style = 'default')` : To Set style to the specified field. supported `['default', 'horizontal']`.

```blade
{{ BsForm::text('username')->style('horizontal') }}
{{ BsForm::text('email')->style('default') }}
```

> `->close()` : To close the form tag.

```blade
{{ BsForm::close() }}
```

<a name="resource"></a>
# # Using Resource With Localed Fields

> You may add localed labels, notes and placeholders using resource option as well:

```blade
@php(BsForm::resource('users'))
```

> You must add `users.php` file to the `resources/lang/en/` path and set the default attributes and notes, placeholders as well:

```php
<?php
return [
    'attributes' => [
        'username' => 'User Name',
        'email' => 'E-mail Address',
        'phone' => 'Phone Number',
    ],
    'notes' => [
        'username' => 'Example: Ahmed Fathy',
        'email' => 'Example: aliraqi-dev@gmail.com',
        'phone' => 'Example: +02xxxxxxxxxxx',
    ],
    'placeholders' => [
        'username' => 'Please enter your name.',
        'email' => 'Please enter your e-mail address.',
        'phone' => 'Please enter your phone number.',
    ],
    ...
];
```

<a name="errorBug"></a>
# # Using Custom Error Message Bag

> You can using custom error bag to display validation errors without any conflict.

```php
// Default error bag
BsForm::errorBag('default');

// Other error bag
BsForm::errorBag('create');
```

<a name="example"></a>
# # Example Register Form

```blade
@php(BsForm::resource('users'))

{{ BsForm::post(route('register')) }}
	{{ BsForm::text('name') }}
	{{ BsForm::email('email') }}
	{{ BsForm::text('phone') }}
	{{ BsForm::submit()->danger() }}
{{ BsForm::close() }}
```

<a name="multilingual"></a>
# # Using Multilingual Form Tabs

```blade
{{ BsForm::post(route('categories.store')) }}
	@multilingualFormTabs
        {{ BsForm::text('name') }}
	@endMultilingualFormTabs

	{{ BsForm::submit()->danger() }}
{{ BsForm::close() }}
```

> Note : the input name inside `@multilingualFormTabs` and `@endMultilingualFormTabs` suffix with `:{lang}`.
>
> Ex. if your supported language is `ar` & `en` the input will be named with `name:ar` & `name:en`.
>
> You should use [Astrotomic/laravel-translatable](https://github.com/Astrotomic/laravel-translatable) and configure it's rule_factory with key format `\Astrotomic\Translatable\Validation\RuleFactory::FORMAT_KEY` to fill the multilingual data like the following example.

```php
Category::create([
    'name:ar' => 'سيارات',
    'name:en' => 'Cars',
]);

// with laravel-bootstrap-forms
Category::create($request->all());
```

<a name="locales"></a>
# # Manage Locales

> You can add your supported locales in `locales.php` config file. you will get it using the following command:

```bash
php artisan vendor:publish --tag=locales:config
```
```php
<?php

use Laraeast\LaravelLocales\Enums\Language;

return [
    /*
    |--------------------------------------------------------------------------
    | Application Locales
    |--------------------------------------------------------------------------
    |
    | Contains the application's supported locales.
    |
    */
    'languages' => [
        Language::EN,
        Language::AR,
    ],
];
```

<a name="bootstrap3"></a>
# # Using Bootstrap 3 or 4

> If you want to use bootstrap 3 you should publish the config file using the following commad and set the bootstrap version globally.

```bash
php artisan vendor:publish --tag=laravel-bootstrap-forms.config
```
```php
<?php

return [
    /**
     * The path of form components views.
     *
     * - 'BsForm::bootstrap5'  - Bootstrap 5
     * - 'BsForm::bootstrap4'  - Bootstrap 4
     * - 'BsForm::bootstrap3'  - Bootstrap 3
     */
    'views' => 'BsForm::bootstrap4',
    ...
];
```

> After change bootstrap version you should clear the cached view files using the `view:clear` artisan command.

```bash
php artisan view:clear
```

<a name="custom-style"></a>
# # Add Custom Style To The Component

> run the `vendor:publish` artisan command to override components views as well.

```bash
php artisan vendor:publish --provider="Laraeast\LaravelBootstrapForms\Providers\BootstrapFormsServiceProvider" --tag laravel-bootstrap-forms.views
```

> will override components in `resources/views/vendor/BsForm` path.

```
- views
	- vendor
		- BsForm
			- bootstrap5
				- text
					- default.blade.php
					- horizontal.blade.php
					- custom.blade.php
				- email
					- default.blade.php
					- horizontal.blade.php
					- custom.blade.php
```

> you can copy `default.blade.php` file as `custom.blade.php` and use custom style as well :

```blade
{{ BsForm::text('name')->style('custom') }}
```

> you can also set the style globally with `BsForm::style()` method before the form open as well:

```blade
@php(BsForm::style('custom'))
```

> or 

```blade
@php(BsForm::resource('users')->style('custom'))
```

> To reset the custom style to the default you should call `clearStyle()` method as well:

```blade
@php(BsForm::clearStyle())
```

> For Example :

```blade
@php(BsForm::resource('users')->style('web'))
{{ BsForm::model($user, route('users.update', $user)) }}
	{{-- All fields here uses web style  --}}
	{{ BsForm::text('name') }} 
	{{ BsForm::text('email') }} 
@php(BsForm::clearStyle())
	{{-- All fields after clearing uses default style  --}}
	{{ BsForm::text('phone') }} 
	{{ BsForm::textarea('address') }} 
	{{ BsForm::submit()->style('inline') }} 
{{ BsForm::close() }}
```

<a name="custom-component"></a>
# # Add Custom Component

> You may add new component class extends `BaseComponent` and register it in your `boot()` method in `AppServiceProvider` class as well:

```php
<?php

namespace App\Form\Components;

use Laraeast\LaravelBootstrapForms\Components\BaseComponent;

class ImageComponent extends BaseComponent
{
    /**
     * The component view path.
     */
    protected string $viewPath = 'components.image';

    /**
     * The image file path.
     */
    protected string $file;

    /**
     * Initialized the input arguments.
     */
    public function init(...$arguments): self
    {
        $this->name = $arguments[0] ?? null;

        $this->file = ($arguments[1] ?? null) ?: 'https://placehold.co/200x200/000000/FFF';

        //$this->setDefaultLabel();

        //$this->setDefaultNote();

        //$this->setDefaultPlaceholder();

        return $this;
    }

    /**
     * Set the file path.
     */
    public function file($file): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * The registered variables in view component.
     */
    protected function viewComposer(): array
    {
        return [
            'file' => $this->file,
        ];
    }
}
```

> Then register the component class in `boot()` method in your `AppServiceProvider` class as well :

```php
<?php

namespace App\Providers;

use App\Form\Components\ImageComponent;
use Illuminate\Support\ServiceProvider;
use Laraeast\LaravelBootstrapForms\Facades\BsForm;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        BsForm::registerComponent('image', ImageComponent::class);
        //...
    }
    //...
```  

> Then publish the BsForm views and create the new component file in `views/vendor/BsForm/bootstrap5/components/image/default.blade.php` path.
   
> Example content of `views/vendor/BsForm/bootstrap5/components/image/default.blade.php` file :

```blade
<?php $invalidClass = $errors->{$errorBag}->has($nameWithoutBrackets) ? ' is-invalid' : ''; ?>
<div class="mb-3">
    @if($label)
        {{ html()->label($label, $name)->attributes(['class' => 'form-label']) }}
    @endif

    {{ html()->file($name)->attributes(array_merge(['class' => 'form-control p-1'.$invalidClass], $attributes)) }}

    @if($inlineValidation)
        @if($errors->{$errorBag}->has($nameWithoutBrackets))
            <div class="invalid-feedback">
                {{ $errors->{$errorBag}->first($nameWithoutBrackets) }}
            </div>
        @else
            <small class="form-text text-muted">{!! $note !!}</small>
        @endif
    @else
        <small class="form-text text-muted">{!! $note !!}</small>
    @endif

    @if($file)
        <div class="row mt-3">
            <div class="col-xs-6 col-md-3">
                <a href="#">
                    <img src="{{ $file }}" class="mw-100" alt="">
                </a>
            </div>
        </div>
    @endif
</div>
```

## Usage

```blade
{{ BsForm::image('photo', $url) }}
```
