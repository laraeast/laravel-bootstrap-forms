<?php $tabuniqid = 'tab-'.$uniqid; ?>
<ul class="nav nav-tabs" id="{{ $tabuniqid }}" role="tablist">
    @multilingualForm
    <li class="nav-item">
        <a class="nav-link{{ $loop->index == 0 ? ' active' : '' }}"
           id="{{ $tabuniqid.'-'.$locale->getCode() }}-tab"
           data-toggle="tab"
           href="#{{ $tabuniqid.'-'.$locale->getCode() }}"
           role="tab"
           aria-controls="{{ $tabuniqid.'-'.$locale->getCode() }}"
           aria-selected="{{ $loop->index == 0 ? 'true' : 'false' }}">
            {{ $locale->getSvgFlag(24, 24) }}
            <span class="ml-2">{{ $locale->getName() }}</span>
        </a>
    </li>
    @endMultilingualForm
</ul>
<div class="tab-content" id="{{ $tabuniqid }}-content">
    @multilingualForm
    <div class="tab-pane fade{{ $loop->index == 0 ? ' show active' : '' }}"
         id="{{ $tabuniqid.'-'.$locale->getCode() }}"
         role="tabpanel"
         aria-labelledby="{{ $tabuniqid.'-'.$locale->getCode() }}-tab">
        <div class="py-2">
            @stack($uniqid.$locale->getCode())
        </div>
    </div>
    @endMultilingualForm
</div>
