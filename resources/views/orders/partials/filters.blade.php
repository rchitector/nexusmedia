<ul class="primary-list">
    <li>
        <a href="{{ route('orders.index') }}" class="tab-item {{ request('financial_status') == null ? 'active' : '' }}" data-tab="tab2">All</a>
    </li>
    @if (!empty($financial_statuses))
        @foreach($financial_statuses as $fs)
            <li>
                <a href="{{ route('orders.index', ['financial_status' => $fs]) }}" class="tab-item {{ request('financial_status') == $fs ? 'active' : '' }}" data-tab="tab2">{{ ucfirst($fs) }}</a>
            </li>
        @endforeach
    @endif
</ul>