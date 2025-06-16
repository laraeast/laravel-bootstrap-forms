<div class="mb-3 row">
    @if($label)
        {{ html()->label($label, $name)->attributes(['class' => 'mb-2 col-sm-2']) }}
    @endif
    <div class="col-sm-10">
        <div class="image-preview d-flex align-items-start align-items-sm-center pb-4" style="gap: 1.5rem; min-width: 270px;">
            <img
                    src="{{ $value ?: sprintf('%s?source=upload', $iconLink) }}"
                    alt="file"
                    class="d-block rounded"
                    style="width: 100px;height: 100px;object-fit: contain;"
            >

            <div class="button-wrapper">
                <label class="btn btn-{{ $uploadColor }} me-3 mb-4" tabindex="0">
                <span class="d-block">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 18h12v2H6zM11 7.41V16h2V7.41l4.29 4.3 1.42-1.42L12 3.59l-6.71 6.7 1.42 1.42z"/>
                    </svg>
                    <span class="d-none d-sm-inline">{{ $uploadLabel }}</span>
                </span>
                    <input
                            type="file"
                            hidden
                            name="{{ $name }}"
                            onchange="
                            const file = this.files[0];
                            const wrapper = this.closest('.image-preview');
                            const img = wrapper.querySelector('img');

                            if (!file) {
                              img.src = '{{ $iconLink }}?source=upload';
                              wrapper.querySelector('.btn-reset').disabled = true
                              return
                            }
                            wrapper.querySelector('.btn-reset').disabled = false

                            const nameWithoutBrackets = '{{ $nameWithoutBrackets }}';
                            let icon = `{{ $iconLink }}?source=${file.type}`;
                            img.src = icon;
                    ">
                </label>

                <button
                        type="button"
                        class="btn btn-{{ $resetColor }} btn-reset mb-4"
                        disabled
                        onclick="
                    const wrapper = this.closest('.image-preview');
                    const img = wrapper.querySelector('img');
                    const input = wrapper.querySelector('input[type=file]');
                    img.src = '{{ $value ?: sprintf('%s?source=upload', $iconLink) }}';
                    input.value = '';
                    this.disabled = true
                ">
                <span class="d-block">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17 6V4c0-1.1-.9-2-2-2H9c-1.1 0-2 .9-2 2v2H2v2h2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8h2V6zM9 4h6v2H9zM6 20V8h12v12z"/>
                        <path d="M9 10h2v8H9zM13 10h2v8h-2z"/>
                    </svg>
                    <span class="d-none d-sm-inline">{{ $resetLabel }}</span>
                </span>
                </button>

                @if($inlineValidation)
                    @if($errors->{$errorBag}->has($nameWithoutBrackets))
                        <small class="text-danger d-block">
                            {{ $errors->{$errorBag}->first($nameWithoutBrackets) }}
                        </small>
                    @else
                        <small class="text-muted d-block">{!! $note !!}</small>
                    @endif
                @else
                    <small class="text-muted d-block">{!! $note !!}</small>
                @endif
                @if($downloadLink)
                    <small class="text-muted d-block">
                        <a href="{{ $downloadLink }}" style="text-decoration: none" target="_blank" download>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.5 2H12.7727C16.0339 2 17.6645 2 18.7969 2.79784C19.1214 3.02643 19.4094 3.29752 19.6523 3.60289C20.5 4.66867 20.5 6.20336 20.5 9.27273V11.8182C20.5 14.7814 20.5 16.2629 20.0311 17.4462C19.2772 19.3486 17.6829 20.8491 15.6616 21.5586C14.4044 22 12.8302 22 9.68182 22C7.88275 22 6.98322 22 6.26478 21.7478C5.10979 21.3424 4.19875 20.4849 3.76796 19.3979C3.5 18.7217 3.5 17.8751 3.5 16.1818V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20.5 12C20.5 13.8409 19.0076 15.3333 17.1667 15.3333C16.5009 15.3333 15.716 15.2167 15.0686 15.3901C14.4935 15.5442 14.0442 15.9935 13.8901 16.5686C13.7167 17.216 13.8333 18.0009 13.8333 18.6667C13.8333 20.5076 12.3409 22 10.5 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4.5 7.5C4.99153 8.0057 6.29977 10 7 10M9.5 7.5C9.00847 8.0057 7.70023 10 7 10M7 10L7 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <span class="ms-1">{{ __('BsForm::attachment.download') }}</span>
                        </a>
                    </small>
                @endif
            </div>
        </div>
    </div>
</div>