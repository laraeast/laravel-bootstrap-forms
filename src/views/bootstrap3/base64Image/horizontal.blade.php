<?php $invalidClass = $errors->{$errorBag}->has($nameWithoutBrackets) ? ' is-invalid' : ''; ?>
<div class="mb-3 row">
    @if($label)
        {{ html()->label($label, $name)->attributes(['class' => 'col-sm-2 col-form-label']) }}
    @endif

    <div class="col-sm-10">
        <div class="image-preview" style="display:flex;gap: 1.5rem;align-items: center;padding-bottom: 1.5rem;">
            <img
                    src="{{ $value ?: $default }}"
                    alt="user-avatar"
                    style="display:block;width: 100px;height: 100px;object-fit: contain;border-radius: .25rem"
            >

            <div class="button-wrapper">
                <label class="btn btn-{{ $uploadColor }}" tabindex="0" style="margin-right: 1rem;margin-bottom: 1.5rem">
                <span style="display: flex;align-items: center;">
                    <svg style="margin-right: .5rem;" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 18h12v2H6zM11 7.41V16h2V7.41l4.29 4.3 1.42-1.42L12 3.59l-6.71 6.7 1.42 1.42z"/>
                    </svg>
                    {{ $uploadLabel }}
                </span>
                    {{ html()->hidden($name, $value ?: '') }}
                    <input
                            type="file"
                            class="hidden"
                            accept="image/*"
                            onchange="
                      const wrapper = this.closest('.image-preview');
                      const img = wrapper.querySelector('img');
                      if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                          img.src = e.target.result;
                          wrapper.querySelector('input[type=hidden]').value = e.target.result;
                        };
                        reader.readAsDataURL(this.files[0]);
                      } else {
                        img.src = '{{ $default }}';
                        wrapper.querySelector('input[type=hidden]').value = ''
                      }
                    ">
                </label>

                <button
                        type="button"
                        class="btn btn-{{ $resetColor }}"
                        style="margin-bottom: 1.5rem"
                        onclick="
                    const wrapper = this.closest('.image-preview');
                    const img = wrapper.querySelector('img');
                    const input = wrapper.querySelector('input[type=file]');
                    img.src = '{{ $default }}';
                    input.value = '';
                    wrapper.querySelector('input[type=hidden]').value = '';
                ">
                <span style="display: flex;align-items: center;">
                    <svg style="margin-right: .5rem;" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17 6V4c0-1.1-.9-2-2-2H9c-1.1 0-2 .9-2 2v2H2v2h2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8h2V6zM9 4h6v2H9zM6 20V8h12v12z"/>
                        <path d="M9 10h2v8H9zM13 10h2v8h-2z"/>
                    </svg>
                    {{ $resetLabel }}
                </span>
                </button>

                @if($inlineValidation)
                    @if($errors->{$errorBag}->has($nameWithoutBrackets))
                        <small class="text-danger" style="display:block;">
                            {{ $errors->{$errorBag}->first($nameWithoutBrackets) }}
                        </small>
                    @else
                        <small class="text-muted" style="display:block;">{!! $note !!}</small>
                    @endif
                @else
                    <small class="text-muted" style="display:block;">{!! $note !!}</small>
                @endif
            </div>
        </div>
    </div>
</div>