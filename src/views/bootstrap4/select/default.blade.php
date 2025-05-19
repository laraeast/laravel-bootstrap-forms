<div class="form-group{{ $errors->{$errorBag}->has($nameWithoutBrackets) ? ' has-error' : '' }}">
    @if($label)
        {{ html()->label($label, $name) }}
    @endif
    @php($input = html()->select($name, $options)->attributes(array_merge(['class' => 'form-control'], $attributes)))

    @if($value)
        @php($input = $input->value($value))
    @endif

    {{ $input }}

    @if($inlineValidation)
        @if($errors->{$errorBag}->has($nameWithoutBrackets))
            <small class="form-text text-muted">{{ $errors->{$errorBag}->first($nameWithoutBrackets) }}</small>
        @else
            <small class="form-text text-muted">{!! $note !!}</small>
        @endif
    @else
        <small class="form-text text-muted">{!! $note !!}</small>
    @endif
</div>
