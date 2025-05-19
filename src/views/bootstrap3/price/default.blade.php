<div class="form-group{{ $errors->{$errorBag}->has($nameWithoutBrackets) ? ' has-error' : '' }}">
    @if($label)
        {{ html()->label($label, $name)->attributes(['class' => 'form-label']) }}
    @endif

    <div class="input-group">
        @if($currency)
            <span class="input-group-addon" id="basic-addon1">{{ $currency }}</span>

        @endif
        @php($input = html()->input('number', $name)->attributes(array_merge(['class' => 'form-control', 'min' => 0, 'step' => $step], $attributes)))

        @if($value)
            @php($input = $input->value($value))
        @endif

        {{ $input }}
    </div>

    @if($inlineValidation)
        @if($errors->{$errorBag}->has($nameWithoutBrackets))
            <small class="text-danger">{{ $errors->{$errorBag}->first($nameWithoutBrackets) }}</small>
        @else
            <small class="text-muted">{!! $note !!}</small>
        @endif
    @else
        <small class="text-muted">{!! $note !!}</small>
    @endif
</div>

