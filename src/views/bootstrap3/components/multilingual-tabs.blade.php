<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        @multilingualForm
        <li role="presentation" class="{{ $loop->index == 0 ? 'active' : '' }}">
            <a href="#{{ $uniqid.'-'.$locale->code }}" aria-controls="{{ $uniqid.'-'.$locale->code }}" role="tab" data-toggle="tab">
                <img src="{{ $locale->flag }}" alt="">
                {{ $locale->name }}
            </a>
        </li>
        @endMultilingualForm
    </ul>

    <!-- Tab panes -->
    <div class="tab-content" style="margin-top: 10px;">
        @multilingualForm
        <div role="tabpanel" class="tab-pane fade{{ $loop->index == 0 ? ' active in' : '' }}" id="{{ $uniqid.'-'.$locale->code }}">
            @stack($uniqid.$locale->code)
        </div>
        @endMultilingualForm
    </div>
</div>