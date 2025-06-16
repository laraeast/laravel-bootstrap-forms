<div class="mb-3">
    @if($label)
        {{ html()->label($label, $name)->attributes(['class' => 'mb-2']) }}
    @endif
    <div class="image-preview" style="display:flex;gap: 1.5rem;align-items: center;padding-bottom: 1.5rem;min-width: 270px;">
        <img
                src="{{ $value ?: $default }}"
                alt="user-avatar"
                style="display:block;width: 100px;height: 100px;object-fit: contain;border-radius: .25rem"
        >

        <div class="button-wrapper">
            <label class="btn btn-{{ $uploadColor }}" tabindex="0" style="margin-right: 1rem;margin-bottom: 1.5rem">
                <span style="display: flex;align-items: center;">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 18h12v2H6zM11 7.41V16h2V7.41l4.29 4.3 1.42-1.42L12 3.59l-6.71 6.7 1.42 1.42z"/>
                    </svg>
                    <span style="margin-left: .5rem;" class="hidden-xs">{{ $uploadLabel }}</span>
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
                        wrapper.querySelector('.btn-reset').disabled = false;
                      } else {
                        img.src = '{{ $default }}';
                        wrapper.querySelector('input[type=hidden]').value = ''
                        wrapper.querySelector('.btn-reset').disabled = true;
                      }
                    ">
            </label>

            <button
                    type="button"
                    class="btn btn-{{ $resetColor }} btn-reset"
                    disabled
                    style="margin-bottom: 1.5rem"
                    onclick="
                    const wrapper = this.closest('.image-preview');
                    const img = wrapper.querySelector('img');
                    const input = wrapper.querySelector('input[type=file]');
                    img.src = '{{ $default }}';
                    input.value = '';
                    wrapper.querySelector('input[type=hidden]').value = '';
                    this.disabled = true;
                ">
                <span style="display: flex;align-items: center;">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17 6V4c0-1.1-.9-2-2-2H9c-1.1 0-2 .9-2 2v2H2v2h2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8h2V6zM9 4h6v2H9zM6 20V8h12v12z"/>
                        <path d="M9 10h2v8H9zM13 10h2v8h-2z"/>
                    </svg>
                    <span style="margin-left: .5rem;" class="hidden-xs">{{ $resetLabel }}</span>
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