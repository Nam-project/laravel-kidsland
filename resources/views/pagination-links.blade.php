<div class="card-footer clearfix">
    @if ($paginator->hasPages())
        <ul class="pagination pagination-sm m-0 float-right">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item">
                    <span class="page-link">
                        «
                    </span>
                </li>
            @else
                <li class="page-item">
                    <button class="page-link" wire:click="previousPage" wire:loading.attr="disabled" rel="prev">
                        «
                    </button>
                </li>
            @endif
            @foreach ($elements as $element)
                {{-- Make dots here --}}
                @if (is_string($element))
                    <li class=""><span class="page-item">{{ $element }}</span></li>
                @endif

                {{-- Links array Here --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page" class="page-item"><button wire:click="gotoPage({{ $page }})"
                                    class="page-link"><span>{{ $page }}</span></button>
                            </li>
                        @else
                            <li class="page-item"><button wire:click="gotoPage({{ $page }})"
                                    class="page-link">{{ $page }}</button></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                    class="page-link">
                        »
                    </button>
                </li>
            @else
                <li class="page-item">
                    <span class="page-link">
                        »
                    </span>
                </li>
            @endif
        </ul>
    @endif
</div>
