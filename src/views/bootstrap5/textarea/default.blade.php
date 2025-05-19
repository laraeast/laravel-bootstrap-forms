<?php $invalidClass = $errors->{$errorBag}->has($nameWithoutBrackets) ? ' is-invalid' : ''; ?>
<div class="mb-3">
    @if($label)
        {{ html()->label($label, $name)->attributes(['class' => 'form-label']) }}
    @endif
    @php($input = html()->textarea($name)->attributes(array_merge([
        'class' => 'form-control'.$invalidClass,
        'style' => 'resize: vertical',
    ], $attributes)))

    @if($value)
        @php($input = $input->value($value))
    @endif

    {{ $input }}

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
