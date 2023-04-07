<div class="pagination">
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="pagination__nav">
            <ul class="pagination__group">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li>
                        <span class="pagination__crumb crumb__default crumb__next">
                            {!! __('pagination.previous') !!}
                        </span>
                    </li>
                @else
                    <li>
                        <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="pagination__crumb crumb__next">
                            {!! __('pagination.previous') !!}
                        </button>
                    </li>
                @endif
                @foreach ($elements as $element)
                    {{-- Make dots here --}}
                    @if (is_string($element))
                        <li class=""><span class="pagination__crumb">{{ $element }}</span></li>
                    @endif
    
                    {{-- Links array Here --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li aria-current="page"><button
                                        wire:click="gotoPage({{ $page }})"
                                        class="pagination__crumb crumb__active"><span>{{ $page }}</span></button></li>
                            @else
                                <li><button wire:click="gotoPage({{ $page }})"
                                        class="pagination__crumb">{{ $page }}</button></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="pagination__crumb crumb__prev">
                            {!! __('pagination.next') !!}
                        </button>
                    </li>
                @else
                    <li>
                        <span class="pagination__crumb crumb__default crumb__prev">
                            {!! __('pagination.next') !!}
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
