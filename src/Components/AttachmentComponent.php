<?php

namespace Laraeast\LaravelBootstrapForms\Components;

use Illuminate\Support\Facades\Lang;

class AttachmentComponent extends BaseComponent
{
    /**
     * The component view path.
     */
    protected string $viewPath = 'attachment';

    protected string $uploadLabel = 'Upload';

    protected string $resetLabel = 'Reset';

    protected string $uploadColor = 'primary';

    protected string $resetColor = 'danger';

    protected array $customIcons = [];

    protected ?string $valueMimeType = null;

    protected ?string $downloadLink = null;

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

        if ($customIcons = config('laravel-bootstrap-forms.attachment.icons.mime-types', [])) {
            $this->customIcons = $customIcons;
        }

        $this->setDefaultStyle();

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

    public function valueMimeType(string $mimeType): self
    {
        $this->valueMimeType = $mimeType;

        return $this;
    }

    public function downloadLink(?string $link = null): self
    {
        $this->downloadLink = $link;

        return $this;
    }

    protected function viewComposer(): array
    {
        return array_merge(parent::viewComposer(), [
            'value' => $this->getValue(),
            'iconLink' => route('bs-form.icon'),
            'valueMimeType' => $this->valueMimeType,
            'downloadLink' => $this->downloadLink,
            'resetLabel' => $this->resetLabel,
            'uploadLabel' => $this->uploadLabel,
            'uploadColor' => $this->uploadColor,
            'resetColor' => $this->resetColor,
        ]);
    }

    public function getValue(): mixed
    {
        return route('bs-form.icon', ['source' => $this->valueMimeType ?: 'upload']);
    }
}
