<?php $invalidClass = $errors->{$errorBag}->has($nameWithoutBrackets) ? ' is-invalid' : ''; ?>
<div class="mb-3">
    @if($label)
        {{ html()->label($label, $name)->attributes(['class' => 'form-label']) }}
    @endif
    @php($input = html()->input('tel', $name)->attributes(array_merge([
        'class' => 'form-control'.$invalidClass,
        'data-max' => $selectedCountry->getMaxDigits(),
        'data-prefix' => $selectedCountry->getPrefix(),
        'oninput' => "let val = this.value.replace(/\D/g, '');
                      const max = parseInt(this.dataset.max) || 10;
                      const prefix = this.dataset.prefix || '';
                      if (! prefix.startsWith(value.slice(0, prefix.length))) {
                        this.value = this.value.slice(0, -1);
                        return;
                      }
                      if(val.length === max) {
                        this.classList.remove('is-invalid');
                      }
                      this.value = val.slice(0, max);",
        'onblur' => "let val = this.value.replace(/\D/g, '');
                      const max = parseInt(this.dataset.max) || 10;
                      const prefix = this.dataset.prefix || '';
                      if (! prefix.startsWith(value.slice(0, prefix.length)) || val.length < max) {
                        this.classList.add('is-invalid');
                        return;
                      } else {
                        this.classList.remove('is-invalid');
                      }
                      this.value = val.slice(0, max);",
        'placeholder' => $selectedCountry->getPhonePlaceholder(),
    ], $attributes)))

    @if($value && phone((string)$value, $selectedCountry->getCode())->isValid())
        @php($input = $input->value($value))
    @endif

    <div class="input-group">
        @if(! empty($countries))
            <div class="input-group-text">
                <select style="border: none; outline: none; background: transparent; font-size: 1rem; padding-left: 0.3rem; cursor: pointer; appearance: none; min-width: 80px;"
                        name="{{ $nameWithoutBrackets }}_country{{ str_contains($name, '[') ? '['.\Illuminate\Support\Str::after($name, '[') : '' }}"
                        onchange="
                            const input=this.closest('.input-group').querySelector('input');
                            input.placeholder = this.options[this.selectedIndex].dataset.placeholder;
                            input.dataset.max = this.options[this.selectedIndex].dataset.max;
                            input.dataset.prefix = this.options[this.selectedIndex].dataset.prefix || '';
                            input.value = '';
                            input.focus()
                        "
                >
                        @foreach($countries as $country)
                            <option
                                    value="{{ $country->getCode() }}"
                                    data-max="{{ $country->getMaxDigits() }}"
                                    data-prefix="{{ $country->getPrefix() }}"
                                    data-placeholder="{{ $country->getPhonePlaceholder() }}"
                                    {{ $selectedCountry->getCode() === $country->getCode() ? 'selected' : '' }}>
                                {{ str_replace([
                                    '{FLAG}',
                                    '{COUNTRY_CODE}',
                                    '{COUNTRY_NAME}',
                                    '{DEAL_CODE}',
                                ],[
                                    $country->getFlag(),
                                    $country->getCode(),
                                    $country->getName(),
                                    $country->getDialCode(),
                                ], $countriesListFormat) }}
                            </option>
                        @endforeach
                </select>
            </div>
        @endif
        {{ $input }}
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
