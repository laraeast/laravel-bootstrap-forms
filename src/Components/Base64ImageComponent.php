<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Illuminate\Support\Facades\Lang;

class Base64ImageComponent extends BaseComponent
{
    /**
     * The component view path.
     */
    protected string $viewPath = 'base64Image';

    protected string $default = 'https://placehold.co/200x200/CCCCCC/444?text=Upload';

    protected string $uploadLabel = 'Upload';

    protected string $resetLabel = 'Reset';

    protected string $uploadColor = 'primary';

    protected string $resetColor = 'danger';

    /**
     * Initialized the input arguments.
     *
     * @param  mixed  ...$arguments
     * @return $this
     */
    public function init(...$arguments): self
    {
        $this->name($name = $arguments[0] ?? null);
        $this->value($arguments[1] ?? null);

        $this->setDefaultLabel($name);

        $this->setDefaultNote($name);

        if (Lang::has($upload = "{$this->resource}.actions.{$name}.upload")) {
            $this->uploadLabel = Lang::get($upload);
        }

        if (Lang::has($upload = "{$this->resource}.actions.{$name}.reset")) {
            $this->resetLabel = Lang::get($upload);
        }

        return $this;
    }

    public function default(string $url): self
    {
        $this->default = $url;

        return $this;
    }

    public function resetLabel(string $resetLabel): self
    {
        $this->resetLabel = $resetLabel;

        return $this;
    }

    public function uploadLabel(string $uploadLabel): self
    {
        $this->uploadLabel = $uploadLabel;

        return $this;
    }

    public function resetColor(string $resetColor): self
    {
        $this->resetColor = $resetColor;

        return $this;
    }

    public function uploadColor(string $uploadColor): self
    {
        $this->uploadColor = $uploadColor;

        return $this;
    }

    protected function viewComposer(): array
    {
        return array_merge(parent::viewComposer(), [
            'default' => $this->default,
            'resetLabel' => $this->resetLabel,
            'uploadLabel' => $this->uploadLabel,
            'uploadColor' => $this->uploadColor,
            'resetColor' => $this->resetColor,
        ]);
    }
}
