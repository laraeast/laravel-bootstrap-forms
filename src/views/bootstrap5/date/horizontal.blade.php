<?php $invalidClass = $errors->{$errorBag}->has($nameWithoutBrackets) ? ' is-invalid' : ''; ?>
<div class="mb-3 row">
    @if($label)
        {{ html()->label($label, $name)->attributes(['class' => 'col-sm-2 col-form-label']) }}
    @endif
    @php($input = html()->input('date', $name)->attributes(array_merge(['class' => 'form-control'.$invalidClass], $attributes)))

    @if($value)
        @php($input = $input->value($value))
    @endif

    <div class="col-sm-10">
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
</div>