<div class="main__content">
    <div class="grid wide">
        <div class="row product__list">
            <div class="shop-filter-panel col l-2">
                <div class="shop-category__list">
                    <div class="shop-category__title">
                        <i class="fa-solid fa-bars"></i>
                        Danh Mục
                    </div>
                    @foreach ($categories as $item)
                        <div for="" class="shop-categories__checkbox">
                            <input id="category{{ $item->id }}" wire:model="categoryInputs"
                                value="{{ $item->id }}" type="checkbox">
                            <span class="checkbox__custom"></span>
                            <label class="shop-category__checktext"
                                for="category{{ $item->id }}">{{ $item->name }}</label>
                        </div>
                    @endforeach
                </div>
                <form action="" wire:submit.prevent="rangePrice">
                    <div class="shop-category__subtitle">Khoảng giá</div>
                    <hr>
                    <div class="shop-price__range">
                        <input type="number" wire:model="fromPrice" placeholder="TỪ -" class="shop-price__range-input">
                    </div>
                    <div class="shop-price__range">
                        <input type="number" wire:model="toPrice" placeholder="ĐẾN" class="shop-price__range-input">
                    </div>
                    <div class="shop-price__range">
                        <button type="submit" class="shop-price__range-apply">ÁP DỤNG</button>
                    </div>
                </form>

            </div>
            <div class="shop-main col l-10">
                <div class="shop-sort-bar">
                    <div class="shop-sort-by-options">
                        <div class="shop-sort-bar__label">Sắp xếp theo</div>
                        {{-- <button class="shop-sort-by-option btn-shop__active" >Mới nhất</button>
                        <button class="shop-sort-by-option">Cũ nhất</button>
                        <button class="shop-sort-by-option">Bán chạy</button> --}}
                        <select name="" id="" class="shop-sort-by__select" wire:model="sorting">
                            <option value="">Sắp xếp theo</option>
                            <option value="orderby_new">Mới nhất</option>
                            <option value="orderby_old">Cũ nhất</option>
                            <option value="price">Giá: Cao đến thấp</option>
                            <option value="price_desc">Giá: Thấp đến cao</option>
                        </select>
                    </div>
                    <div class="shop-mini-page-controller">
                        <select name="" id="" class="shop-sort-by__select" wire:model="pagesize">
                            <option value="15">15 trên trang</option>
                            <option value="20">20 trên trang</option>
                            <option value="25">25 trên trang</option>
                            <option value="30">30 trên trang</option>
                        </select>
                    </div>
                </div>
                @if ($products->count() > 0)
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col l-2-4 m-3 c-6 product__item">
                                <div class="product__item-link">
                                    <a href="{{ Route('product.details', ['slug' => $product->slug]) }}">
                                        <img src="{{ asset('assets/imgs/products/' . $product->image) }}"
                                            alt="{{ $product->name }}" class="product__img">
                                        <div class="product__name">{{ $product->name }}
                                        </div>
                                        <div class="product__group">
                                            <div class="product__price">
                                                @if ($product->sale_price > 0)
                                                    {{ number_format($product->sale_price, 0) }}
                                                @else
                                                    {{ number_format($product->regular_price, 0) }}
                                                @endif <span class="copper">đ</span>
                                            </div>
                                            <div class="product__assess">5<i class="fa-solid fa-star"></i></i></div>
                                        </div>
                                    </a>
                                    <div class="product__with-cart">
                                        <a href=""
                                            wire:click.prevent="storeBuy({{ $product->id }},'{{ $product->name }}',{{ $product->sale_price > 0 ? $product->sale_price : $product->regular_price }})"
                                            class="product__buy-now btn-pink">Mua ngay</a>
                                        <button class="product__cart"
                                            wire:click.prevent="store({{ $product->id }},'{{ $product->name }}',{{ $product->sale_price > 0 ? $product->sale_price : $product->regular_price }})">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="cart-empty">
                        <img src="{{ asset('assets/imgs/icon/search-none.png') }}" alt=""
                            class="img-cart-drum">
                        <h2 class="cart-empty-title">Không tìm thấy sản phẩm</h2>
                    </div>
                @endif
            </div>
        </div>
        {{ $products->links('custom-pagination-links-view') }}
    </div>
</div>
