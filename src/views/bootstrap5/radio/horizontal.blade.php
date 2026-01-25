@php($id = 'radio-'.Str::random('4').'-'.$name)
@php($invalidClass = $errors->{$errorBag}->has($nameWithoutBrackets) ? ' is-invalid' : '')

<div class="mb-3 row">
    <div class="col-sm-10 offset-sm-2">
        <div class="form-check">
            @php($input = html()->radio($name)->value($value)->attributes(['class' => 'form-check-input'.$invalidClass, 'id' => $id]))

            @if($checked)
                @php($input = $input->checked($checked))
            @endif

            {{ $input }}
            <label class="form-check-label" for="{{ $id }}">
                {!! $label !!}
            </label>
        </div>
        @if($inlineValidation)
            @if($errors->{$errorBag}->has($nameWithoutBrackets))
                <small class="form-text text-danger ps-4">
                    {{ $errors->{$errorBag}->first($nameWithoutBrackets) }}
                </small>
            @else
                @if($note) <small class="form-text text-muted ps-4">{!! $note !!}</small> @endif
            @endif
        @else
            @if($note) <small class="form-text text-muted ps-4">{!! $note !!}</small> @endif
        @endif
    </div>
</div>

