<?php
$id = 'checkbox-'.Str::random('4').'-'.$name;
$invalidClass = $errors->{$errorBag}->has($nameWithoutBrackets) ? ' is-invalid' : '';

?>
@php($input = html()->checkbox($name)->value($value)->attributes(['class' => 'form-check-input'.$invalidClass, 'id' => $id, ...$attributes]))

@if($checked)
    @php($input = $input->checked($checked))
@endif

<div class="form-group">
    <div class="form-check">
        @if($hasDefaultValue)
            {{ $hiddenInput = html()->hidden($name)->value($defaultValue) }}
        @endif
        {{ $input }}
        <label class="form-check-label" for="{{ $id }}">
            {!! $label !!}
        </label>
        @if($inlineValidation)
            @if($errors->{$errorBag}->has($nameWithoutBrackets))
                <small class="form-text text-danger ps-4">
                    {{ $errors->{$errorBag}->first($nameWithoutBrackets) }}
                </small>
            @else
                @if($note) <small class="form-text text-muted">{!! $note !!}</small> @endif
            @endif
        @else
            @if($note) <small class="form-text text-muted">{!! $note !!}</small> @endif
        @endif
    </div>
</div>

