<?php $invalidClass = $errors->{$errorBag}->has($nameWithoutBrackets) ? ' is-invalid' : ''; ?>
<div class="mb-3 row">
    @if($label)
        {{ html()->label($label, $name)->attributes(['class' => 'col-sm-2 col-form-label']) }}
    @endif
    @php($input = html()->input('time', $name)->attributes(array_merge(['class' => 'form-control'.$invalidClass], $attributes)))

    @if($value)
        @php($input = $input->value($value))
    @endif

    <div class="col-sm-10">
        <div class="input-group">
            @if($currency)
                <span class="input-group-text">{{ $currency }}</span>
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
</div>