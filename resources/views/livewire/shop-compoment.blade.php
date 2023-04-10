<div class="main__content">
    <div class="grid wide">
        <div class="row product__list">
            <div class="shop-filter-panel col l-2">
                <div class="shop-category__list">
                    <div class="shop-category__title">
                        <i class="fa-solid fa-bars"></i>
                        Danh Mục
                    </div>
                </div>
            </div>
            <div class="shop-main col l-10">
                <div class="shop-sort-bar">
                    <div class="shop-sort-by-options">
                        <div class="shop-sort-bar__label">Sắp xếp theo</div>
                        <button class="shop-sort-by-option btn-shop__active">Mới nhất</button>
                        <button class="shop-sort-by-option">Cũ nhất</button>
                        <button class="shop-sort-by-option">Bán chạy</button>
                        <div class="shop-sort-by-price"><span>Giá</span><i class="fa-solid fa-caret-down"></i>
                            <ul class="shop-sort-by-price__select">
                                <li ><button class="shop-sort-by-price__item">Giá: Thấp đến cao</button></li>
                                <li ><button class="shop-sort-by-price__item">Giá: Cao đến thấp</button></li>
                            </ul>
                        </div>
                    </div>
                    <div class="shop-mini-page-controller">

                    </div>
                </div>
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
                                        <div class="product__price">{{ $product->sale_price }} <span
                                                class="copper">đ</span></div>
                                        <div class="product__assess">5<i class="fa-solid fa-star"></i></i></div>
                                    </div>
                                </a>
                                <div class="product__with-cart">
                                    <a href="" class="product__buy-now btn-pink">Mua ngay</a>
                                    <button onclick="updateCartCount()" class="product__cart"
                                        wire:click.prevent="store({{ $product->id }},'{{ $product->name }}',{{ $product->regular_price }})">
                                        <i class="fa-solid fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{ $products->links('custom-pagination-links-view') }}
    </div>
</div>
