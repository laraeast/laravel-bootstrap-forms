<div class="form-group{{ $errors->{$errorBag}->has($nameWithoutBrackets) ? ' has-error' : '' }}">
    @if($label)
        {{ html()->label($label, $name)->attributes(['class' => 'content-label']) }}
    @endif
    @php($input = html()->input('color', $name)->attributes(array_merge([
        'class' => 'form-control',
        'style' => 'width:50px;padding:0'
    ], $attributes)))

    @if($value)
        @php($input = $input->value($value))
    @endif

    {{ $input }}

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
