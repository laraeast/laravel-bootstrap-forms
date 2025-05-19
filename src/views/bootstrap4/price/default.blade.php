<?php $invalidClass = $errors->{$errorBag}->has($nameWithoutBrackets) ? ' is-invalid' : ''; ?>

<div class="mb-3">
    @if($label)
        {{ html()->label($label, $name)->attributes(['class' => 'form-label']) }}
    @endif

    <div class="input-group">
        @if($currency)
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">{{ $currency }}</span>
            </div>
        @endif
        @php($input = html()->input('number', $name)->attributes(array_merge(['class' => 'form-control'.$invalidClass, 'min' => 0, 'step' => $step], $attributes)))

        @if($value)
            @php($input = $input->value($value))
        @endif

        {{ $input }}
    </div>

    @if($inlineValidation)
        @if($errors->{$errorBag}->has($nameWithoutBrackets))
            <div class="form-text text-danger">
                {{ $errors->{$errorBag}->first($nameWithoutBrackets) }}
            </div>
        @else
            <small class="form-text text-muted">{!! $note !!}</small>
        @endif
    @else
        <small class="form-text text-muted">{!! $note !!}</small>
    @endif
</div>

