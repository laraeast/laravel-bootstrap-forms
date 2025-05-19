@php($id = 'radio-'.Str::random('4').'-'.$name)

<div class="mb-3">
    <div class="form-check">
        @php($input = html()->radio($name)->value($value)->attributes(['class' => 'form-check-input', 'id' => $id]))

        @if($checked)
            @php($input = $input->checked($checked))
        @endif

        {{ $input }}
        <label class="form-check-label" for="{{ $id }}">
            {!! $label !!}
        </label>
    </div>
    <small class="form-text text-muted ps-4">{!! $note !!}</small>
</div>


