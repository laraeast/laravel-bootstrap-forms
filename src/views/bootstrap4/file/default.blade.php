<?php $invalidClass = $errors->{$errorBag}->has($nameWithoutBrackets) ? ' is-invalid' : ''; ?>
<div class="form-group">
    @if($label)
        {{ html()->label($label, $name) }}
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
</div>
