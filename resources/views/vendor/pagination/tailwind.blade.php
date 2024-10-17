@if ($paginator->hasPages())
    <div class="table-result">
        {!! __('Showing') !!}
        @if ($paginator->firstItem())
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            {!! __('to') !!}
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
        @else
            {{ $paginator->count() }}
        @endif
        {!! __('of') !!}
        <span class="font-medium">{{ $paginator->total() }}</span>
        {!! __('results') !!}
    </div>
    <div class="button-group">
        <span data-href="{{ $paginator->onFirstPage() ? '#' : $paginator->previousPageUrl() }}"
              {{ $paginator->onFirstPage() ? 'disabled' : ''}} class="btn btn btn-icon btn-no-label pagination-button">
            <span class="btn-icon-holder">
                <svg viewBox="0 0 20 20" class="Icon_Icon__Dm3QW" style="width: 20px; height: 20px;"><path
                            d="M12 16a.997.997 0 0 1-.707-.293l-5-5a.999.999 0 0 1 0-1.414l5-5a.999.999 0 1 1 1.414 1.414l-4.293 4.293 4.293 4.293a.999.999 0 0 1-.707 1.707z"></path></svg>
            </span>
            prev
        </span>
        <span data-href="{{ $paginator->hasMorePages() ? $paginator->nextPageUrl() : '#'}}"
              {{ $paginator->hasMorePages() ? '' : 'disabled'}} class="btn btn btn-icon btn-no-label pagination-button">
            <span class="btn-icon-holder">
                <svg viewBox="0 0 20 20" class="Icon_Icon__Dm3QW" style="width: 20px; height: 20px;"><path
                            d="M8 16a.999.999 0 0 1-.707-1.707l4.293-4.293-4.293-4.293a.999.999 0 1 1 1.414-1.414l5 5a.999.999 0 0 1 0 1.414l-5 5a.997.997 0 0 1-.707.293z"></path></svg>
            </span>
            next
        </span>
    </div>
@endif
