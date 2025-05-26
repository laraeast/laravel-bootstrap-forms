<?php $invalidClass = $errors->{$errorBag}->has($nameWithoutBrackets) ? ' is-invalid' : ''; ?>
<div class="form-group">
    @if($label)
        {{ html()->label($label, $name) }}
    @endif

        <div class="input-group">
            {{ html()->input('password', $name)->attributes(array_merge(['class' => 'form-control'.$invalidClass], $attributes)) }}
            <div class="input-group-append">
                <span class="input-group-text cursor-pointer" onclick="
                let group = this.closest('.input-group');
                let input = group.querySelector('input');
                let showIcon = this.querySelector('.show-icon');
                    let hideIcon = this.querySelector('.hide-icon');
                    if (input.type === 'password') {
                      input.type = 'text';
                      showIcon.style.display = 'none';
                      hideIcon.style.display = 'inline';
                    } else {
                      input.type = 'password';
                      showIcon.style.display = 'inline';
                      hideIcon.style.display = 'none';
                    }">
                    <svg class="hide-icon{{ $errors->{$errorBag}->has($nameWithoutBrackets) ? ' text-danger' : '' }}" style="display: none" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 5c-7.63 0-9.93 6.62-9.95 6.68-.07.21-.07.43 0 .63.02.07 2.32 6.68 9.95 6.68s9.93-6.62 9.95-6.68c.07-.21.07-.43 0-.63C21.93 11.61 19.63 5 12 5m0 12c-5.35 0-7.42-3.84-7.93-5 .5-1.16 2.58-5 7.93-5s7.42 3.85 7.93 5c-.5 1.16-2.58 5-7.93 5"/>
                        <path d="M13.5 12c-.83 0-1.5-.67-1.5-1.5 0-.6.36-1.12.87-1.35-.28-.09-.56-.15-.87-.15-1.64 0-3 1.36-3 3s1.36 3 3 3 3-1.36 3-3c0-.3-.06-.59-.15-.87-.24.51-.75.87-1.35.87"/>
                    </svg>
                    <svg class="show-icon{{ $errors->{$errorBag}->has($nameWithoutBrackets) ? ' text-danger' : '' }}" style="display: inline" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 17c-5.35 0-7.42-3.84-7.93-5 .2-.46.65-1.34 1.45-2.23l-1.4-1.4c-1.49 1.65-2.06 3.28-2.08 3.31-.07.21-.07.43 0 .63.02.07 2.32 6.68 9.95 6.68.91 0 1.73-.1 2.49-.26l-1.77-1.77c-.24.02-.47.03-.72.03ZM21.95 12.32c.07-.21.07-.43 0-.63-.02-.07-2.32-6.68-9.95-6.68-1.84 0-3.36.39-4.61.97L2.71 1.29 1.3 2.7l4.32 4.32 1.42 1.42 2.27 2.27 3.98 3.98 1.8 1.8 1.53 1.53 4.68 4.68 1.41-1.41-4.32-4.32c2.61-1.95 3.55-4.61 3.56-4.65m-7.25.97c.19-.39.3-.83.3-1.29 0-1.64-1.36-3-3-3-.46 0-.89.11-1.29.3l-1.8-1.8c.88-.31 1.9-.5 3.08-.5 5.35 0 7.42 3.85 7.93 5-.3.69-1.18 2.33-2.96 3.55z"/>
                    </svg>
                </span>
            </div>
        </div>

    @if($inlineValidation)
        @if($errors->{$errorBag}->has($nameWithoutBrackets))
            <small class="form-text text-danger">
                {{ $errors->{$errorBag}->first($nameWithoutBrackets) }}
            </small>
        @else
            <small class="form-text text-muted">{!! $note !!}</small>
        @endif
    @else
        <small class="form-text text-muted">{!! $note !!}</small>
    @endif
</div>