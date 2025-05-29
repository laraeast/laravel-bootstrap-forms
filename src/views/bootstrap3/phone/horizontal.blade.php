<div class="form-group{{ $errors->{$errorBag}->has($nameWithoutBrackets) ? ' has-error' : '' }}">
    <div class="row">
        @if($label)
            {{ html()->label($label, $name)->attributes(['class' => 'content-label col-sm-2']) }}
        @else
            <div class="col-sm-2"></div>
        @endif

        <div class="col-sm-10">

            @php($input = html()->input('tel', $name)->attributes(array_merge([
                'class' => 'form-control',
                'data-max' => $selectedCountry->getMaxDigits(),
                    'data-prefix' => $selectedCountry->getPrefix(),
                'oninput' => "let val = this.value.replace(/\D/g, '');
                              const max = parseInt(this.dataset.max) || 10;
                              const prefix = this.dataset.prefix || '';
                              if (! prefix.startsWith(value.slice(0, prefix.length))) {
                                this.value = this.value.slice(0, -1);
                                return;
                              }
                              if (val.length === max) {
                                this.closest('.form-group').classList.remove('has-error');
                              }
                              this.value = val.slice(0, max);",
                'onblur' => "let val = this.value.replace(/\D/g, '');
                              const max = parseInt(this.dataset.max) || 10;
                              const prefix = this.dataset.prefix || '';
                              if (! prefix.startsWith(value.slice(0, prefix.length)) || val.length < max) {
                                this.closest('.form-group').classList.add('has-error');
                                return;
                              } else {
                                this.closest('.form-group').classList.remove('has-error');
                              }
                              this.value = val.slice(0, max);",
                'placeholder' => $selectedCountry->getPhonePlaceholder(),
            ], $attributes)))

            @if($value)
                @php($input = $input->value($value))
            @endif

            <div class="input-group">
                @if(! empty($countries))
                    <span class="input-group-addon" id="basic-addon1">
                        <select style="border: none; outline: none; background: transparent; font-size: 1.2rem; padding-left: 0.3rem; cursor: pointer; appearance: none; min-width: 80px;"
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
                    </span>
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
