<div class="form-group{{ $errors->{$errorBag}->has($nameWithoutBrackets) ? ' has-error' : '' }}">
    <div class="row">
        @if($label)
            {{ html()->label($label, $name)->attributes(['class' => 'content-label col-sm-2']) }}
        @endif
        @php($input = html()->input('time', $name)->attributes(array_merge(['class' => 'form-control'], $attributes)))

        @if($value)
            @php($input = $input->value($value))
        @endif

        <div class="col-sm-10">
            <div class="form-group">

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
        </div>
    </div>
</div>