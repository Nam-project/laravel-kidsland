<div class="search">
    <form action="{{ route('product.search') }}" class="search-ip">
        <input type="text" class="search__input" autocomplete="off" value="{{ $search }}" wire:model="search"
            name="search" wire:keyup="searchResult" placeholder="Bố mẹ tìm gì cho bé hôm nay ?">
        <button type="submit" class="search__btn"><i class="fa-solid search__icon fa-magnifying-glass"></i></button>
    </form>
    @if ($showDiv)
        <div class="search-more">
            <ul class="search-more__group">
                @if (!empty($records))
                    @foreach ($records as $record)
                        <li class="search-more__item" wire:click="fetchEmployeeDetail({{ $record->id }})">{{ $record->name }}</li>
                    @endforeach
                @endif

            </ul>
        </div>
    @endif
</div>
