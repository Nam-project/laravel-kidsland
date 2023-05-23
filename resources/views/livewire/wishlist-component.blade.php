<div class="main__content">
    <div class="grid wide">
        <div class="product__breadcrumb">
            <a href="/">Trang chủ</a><i class="fa-solid fa-angle-right"></i>
            <span>Sản phẩm yêu thích</span>
        </div>
        @if (Cart::instance('wishlist')->content()->count() > 0)
            <div class="row product__list pb__35">
                @foreach (Cart::instance('wishlist')->content() as $item)
                    <div class="col l-2 m-3 c-6 product__item">
                        <div class="product__item-link">
                            <button wire:click.prevent="removeFromWishlist({{ $item->id }})"
                                class="favorite-btn clicked"><i class="fas fa-heart"></i></button>
                            <a href="{{ Route('product.details', ['slug' => $item->model->slug]) }}">
                                <img src="{{ asset('assets/imgs/products') }}/{{ $item->model->image }}" alt=""
                                    class="product__img">
                                <div class="product__name">{{ $item->name }}
                                </div>
                                <div class="product__group">
                                    <div class="product__price">{{ $item->price }}<span class="copper">đ</span>
                                    </div>
                                    <div class="product__assess">5<i class="fa-solid fa-star"></i></div>
                                </div>
                            </a>
                            <div class="product__with-cart">
                                <a href=""
                                    wire:click.prevent="storeBuy({{ $item->id }},'{{ $item->name }}',{{ $item->price }})"
                                    class="product__buy-now btn-pink">Mua ngay</a>
                                <button class="product__cart"
                                    wire:click.prevent="store({{ $item->id }},'{{ $item->name }}',{{ $item->price }})">
                                    <i class="fa-solid fa-cart-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="cart-empty">
                <img src="{{ asset('assets/imgs/icon/email.png') }}" alt="" class="img-cart-drum">
                <h2 class="cart-empty-title">Chưa có sản phẩm yêu thích</h2>
            </div>
        @endif
    </div>
</div>
