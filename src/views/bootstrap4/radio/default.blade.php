@php($id = 'radio-'.Str::random('4').'-'.$name)

<div class="form-group">
    <div class="form-check">
        @php($input = html()->radio($name)->value($value)->attributes(['class' => 'form-check-input', 'id' => $id]))

        @if($checked)
            @php($input = $input->checked($checked))
        @endif

        {{ $input }}
        <label class="form-check-label" for="{{ $id }}">
            {!! $label !!}
        </label>
        <small class="form-text text-muted">{!! $note !!}</small>
    </div>
</div>


