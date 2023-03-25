<div class="form-group{{ $errors->{$errorBag}->has($nameWithoutBrackets) ? ' has-error' : '' }}">
    <div class="row">
        @if($label)
            {{ Form::label($name, $label, ['class' => 'content-label col-md-2']) }}
        @else
            <div class="col-md-2"></div>
        @endif

        <div class="col-md-10">

            {{ Form::password($name, array_merge(['class' => 'form-control'], $attributes)) }}

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
