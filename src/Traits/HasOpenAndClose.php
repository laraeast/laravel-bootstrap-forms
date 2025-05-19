<?php

namespace Laraeast\LaravelBootstrapForms\Traits;

use Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

trait HasOpenAndClose
{
    /**
     * Open the form tag.
     */
    public function open(string $url, array $attributes = []): \Spatie\Html\Elements\Form
    {
        return html()->form(
            Str::upper(data_get($attributes, 'method', 'GET')),
            $url,
        )->attributes($attributes);
    }

    /**
     * Open the form tag with get method.
     */
    public function get(string $url, array $attributes = []): \Spatie\Html\Elements\Form
    {
        return html()->form(method: 'GET', action: $url)->attributes(attributes: $attributes);
    }

    /**
     * Open the form tag with post method.
     */
    public function post(string $url, array $attributes = []): \Spatie\Html\Elements\Form
    {
        return html()->form(method: 'POST', action: $url)->attributes(attributes: $attributes);
    }

    /**
     * Open the form tag with put method.
     */
    public function put(string $url, array $attributes = []): \Spatie\Html\Elements\Form
    {
        return html()->form(method: 'PUT', action: $url)->attributes(attributes: $attributes);
    }

    /**
     * Open the form tag with patch method.
     */
    public function patch(string $url, array $attributes = []): \Spatie\Html\Elements\Form
    {
        return html()->form(method: 'PATCH', action: $url)->attributes(attributes: $attributes);
    }

    /**
     * Open the form tag with delete method.
     */
    public function delete(string $url, array $attributes = []): \Spatie\Html\Elements\Form
    {
        return html()->form(method: 'DELETE', action: $url)->attributes(attributes: $attributes);
    }

    /**
     * Open the form tag with model and put method.
     */
    public function model(Model $model, string $url, string $method = 'PUT', array $attributes = []): \Spatie\Html\Elements\Form
    {
        return html()->modelForm(model: $model, method: $method, action: $url)->attributes(attributes: $attributes);
    }

    /**
     * Open the form tag with model and put method.
     */
    public function putModel(Model $model, string $url, array $attributes = []): \Spatie\Html\Elements\Form
    {
        return $this->model($model, $url, 'PUT', $attributes);
    }

    /**
     * Open the form tag with model and patch method.
     */
    public function patchModel(Model $model, string $url, array $attributes = []): \Spatie\Html\Elements\Form
    {
        return $this->model($model, $url, 'PATCH', $attributes);
    }

    /**
     * Close the form tag.
     */
    public function close(): \Illuminate\Contracts\Support\Htmlable
    {
        return html()->closeModelForm();
    }
}