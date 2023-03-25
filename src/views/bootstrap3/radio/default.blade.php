<div class="form-group{{ $errors->{$errorBag}->has($nameWithoutBrackets) ? ' has-error' : '' }}">
    <div class="checkbox">
        <label>
            {{ Form::radio($name, $value, $checked) }} {!! $label !!}
        </label>
    </div>
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

