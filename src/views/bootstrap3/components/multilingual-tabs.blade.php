<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        @multilingualForm
        <li role="presentation" class="{{ $loop->index == 0 ? 'active' : '' }}">
            <a style="display:flex;align-items: center;" href="#{{ $uniqid.'-'.$locale->getCode() }}" aria-controls="{{ $uniqid.'-'.$locale->getCode() }}" role="tab" data-toggle="tab">
                {{ $locale->getSvgFlag(24, 24) }}
                <span style="margin-left: 1rem;">{{ $locale->getName() }}</span>
            </a>
        </li>
        @endMultilingualForm
    </ul>

    <!-- Tab panes -->
    <div class="tab-content" style="margin-top: 10px;">
        @multilingualForm
        <div role="tabpanel" class="tab-pane fade{{ $loop->index == 0 ? ' active in' : '' }}" id="{{ $uniqid.'-'.$locale->getCode() }}">
            @stack($uniqid.$locale->getCode())
        </div>
        @endMultilingualForm
    </div>
</div>