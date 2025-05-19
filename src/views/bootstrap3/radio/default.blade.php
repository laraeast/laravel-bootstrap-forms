@php($id = 'radio-'.Str::random('4').'-'.$name)
@php($input = html()->radio($name)->value($value)->attributes(['id' => $id]))

@if($checked)
    @php($input = $input->checked($checked))
@endif
<div class="form-group{{ $errors->{$errorBag}->has($nameWithoutBrackets) ? ' has-error' : '' }}">
    <div class="checkbox">
        <label for="{{ $id }}">
            {{ $input }} {!! $label !!}
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

