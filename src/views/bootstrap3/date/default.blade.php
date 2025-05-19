<div class="form-group{{ $errors->{$errorBag}->has($nameWithoutBrackets) ? ' has-error' : '' }}">
    @if($label)
        {{ html()->label($label, $name)->attributes(['class' => 'content-label']) }}
    @endif
    @php($input = html()->input('date', $name)->attributes(array_merge(['class' => 'form-control'], $attributes)))

    @if($value)
        @php($input = $input->value($value))
    @endif

    {{ $input }}

    @if($inlineValidation)
        @if($errors->{$errorBag}->has($nameWithoutBrackets))
            <strong class="help-block">{{ $errors->{$errorBag}->first($nameWithoutBrackets) }}</strong>
        @else
            <strong class="help-block">{!! $note !!}</strong>
        @endif
    @else
        <strong class="help-block">{!! $note !!}</strong>
    @endif
</div>
