<?php
$id = 'checkbox-'.Str::random('4').'-'.$name;
?>
@php($input = html()->checkbox($name)->value($value)->attributes(['class' => 'form-check-input', 'id' => $id]))

@if($checked)
    @php($input = $input->checked($checked))
@endif
<div class="mb-3 row">
    <div class="col-sm-10 offset-sm-2">
        <?php
        $id = 'checkbox-'.Str::random('4').'-'.$name;
        ?>
        @php($input = html()->checkbox($name)->value($value)->attributes(['class' => 'form-check-input', 'id' => $id]))

        @if($checked)
            @php($input = $input->checked($checked))
        @endif
        <div class="form-check">
            @if($hasDefaultValue)
                {{ $hiddenInput = html()->hidden($name)->value($defaultValue) }}
            @endif
            {{ $input }}
            <label class="form-check-label" for="{{ $id }}">
                {!! $label !!}
            </label>
        </div>
        <small class="form-text text-muted ps-4">{!! $note !!}</small>
    </div>
</div>

