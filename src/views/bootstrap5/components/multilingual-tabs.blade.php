<?php $tabuniqid = 'tab-'.$uniqid; ?>
<nav>
    <div class="nav nav-tabs" id="{{ $tabuniqid }}" role="tablist">
        @multilangualForm
        <button class="nav-link{{ $loop->index == 0 ? ' active' : '' }}"
                id="{{ $tabuniqid.$locale->code }}-tab"
                data-bs-toggle="tab"
                data-bs-target="#{{ $tabuniqid.$locale->code }}"
                type="button"
                role="tab"
                aria-controls="{{ $tabuniqid.$locale->code }}"
                aria-selected="{{ $loop->index == 0 ? 'true' : 'false' }}">
            <img src="{{ $locale->flag }}" class="mx-1" alt="">
            {{ $locale->name }}
        </button>
        @endMultilangualForm
    </div>
</nav>
<div class="tab-content" id="{{ $tabuniqid }}Content">
    @multilangualForm
    <div class="tab-pane fade{{ $loop->index == 0 ? ' show active' : '' }}"
         id="{{ $tabuniqid.$locale->code }}"
         role="tabpanel"
         aria-labelledby="{{ $tabuniqid.$locale->code }}-tab">
        <div class="py-2">
            @stack($uniqid.$locale->code)
        </div>
    </div>
    @endMultilangualForm
</div>