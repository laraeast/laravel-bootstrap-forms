<?php $invalidClass = $errors->{$errorBag}->has($nameWithoutBrackets) ? ' is-invalid' : ''; ?>
<div class="form-group row">
    @if($label)
        {{ html()->label($label, $name)->attributes(['class' => 'col-sm-2 col-form-label']) }}
    @endif

    <div class="col-sm-10">
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
</div>