<div class="form-group{{ $errors->{$errorBag}->has($nameWithoutBrackets) ? ' has-error' : '' }}">
    <div class="row">
        @if($label)
            {{ html()->label($label, $name)->attributes(['class' => 'content-label col-sm-2']) }}
        @else
            <div class="col-sm-2"></div>
        @endif

        <div class="col-sm-10">

            {{ html()->file($name)->attributes(array_merge(['class' => 'form-control'], $attributes)) }}

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
    </div>
</div>
