<div class="main__content">
    <div class="grid wide">
        {{-- <div wire:loading.class="opacity-50">
            @if (session()->has('success_message'))
                <div id="toast" class="toast">
                    <i class="fas fa-check-circle toast__icon"></i>
                    <div>
                        <div class="toast__title">Thành công</div>
                        <div class="toast__text">{{ session('success_message') }}</div>
                    </div>
                    <button class="toast__close" wire:click.prevent="closeAlert"><i class="fas fa-times"></i></button>
                </div>
            @endif
        </div> --}}
        <div class="row no-gutters">
            <div class="col l-2 c-0 m-0 category__group">
                <ul class="category-list">
                    <div class="category__title"><i class="fa-solid fa-bars"></i>Danh mục</div>
                    @foreach ($category as $item)
                        <li class="category-item"><a
                                href="{{ route('product.category', ['category_slug' => $item->slug]) }}"
                                class="category__link">{{ $item->name }}<i
                                    class="fa-solid fa-angle-right category-icon"></i> </a>
                            <div class="content__subcategory">
                                <img class="content__subcategory-img"
                                    src="{{ asset('assets/imgs/categories') }}/{{ $item->image }}" alt="">
                                @if (count($item->subcategory) > 0)
                                    <ul class="subcategory__title-gr">
                                        <h4 class="subcategory__heading">Theo loại</h4>
                                        @foreach ($item->subcategory as $subcate)
                                            <li class="subcategory__title"><a class="subcategory__title-link"
                                                    href="{{ route('product.category', ['category_slug' => $item->slug, 'subcategory_slug' => $subcate->slug]) }}">{{ $subcate->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                                @if (count($item->brand) > 0)
                                    <ul class="brands__title-gr">
                                        <h4 class="subcategory__heading">Thương hiệu</h4>
                                        @foreach ($item->brand as $brand)
                                            <li class="subcategory__title"><a class="subcategory__title-link"
                                                    href="{{ url('product-category/' . $brand->category->slug . '?brandInputs[0]=' . $brand->id) }}">{{ $brand->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                                @if (count($item->weightAge) > 0)
                                    <ul class="weightage__title-gr">
                                        <h4 class="subcategory__heading">Size</h4>
                                        @foreach ($item->weightAge as $weightAge)
                                            <li class="subcategory__title"><a class="subcategory__title-link"
                                                    href="">{{ $weightAge->name }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col l-10 c-12 m-12">
                <div class="content__slider">
                    <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" navigation="true"
                        space-between="0" loop="true" speed="1000" centered-slides="true" autoplay-delay="3500"
                        autoplay-disable-on-interaction="false">
                        @foreach ($sliders as $slider)
                            <swiper-slide><a class="slide__link" href="{{ $slider->link }}"><img class="slider__img"
                                        src="{{ asset('assets/imgs/sliders') }}/{{ $slider->image }}"
                                        alt=""></a>
                            </swiper-slide>
                        @endforeach
                    </swiper-container>
                </div>
            </div>
        </div>
        <div class="flast-sale" wire:ignore>
            <div class="flast-sale__titles">
                <div class="flast-sale__title">
                    <div class="flast-sale__title-text">
                        Giá sốc hôm nay
                    </div>
                    <div class="count-time">
                        <span class="count-time__number" id="demo"></span>

                    </div>
                </div>
                <a class="flast-sale__more" href="">
                    Xem thêm
                    <i class="fa-solid flast-sale__more-i fa-angle-right"></i>
                </a>
            </div>
            <div class="row flast-sale__list">
                @foreach ($saleProducts as $product)
                    <div class="col l-2 m-3 c-6 flast-sale__item">
                        <a href="{{ route('product.details', ['slug' => $product->slug]) }}" class="flast-sale__link">
                            <img src="{{ asset('assets/imgs/products') }}/{{ $product->image }}" alt=""
                                class="sale__item-img">
                            <div class="flast-sale__name">{{ $product->name }}
                            </div>
                            <div class="flast-sale__price">
                                <div class="sale__price-old">{{ number_format($product->regular_price, 0) }}<span class="copper">đ</span>
                                </div>
                                <div class="sale__price-new">{{ number_format($product->sale_price, 0) }}<span class="copper">đ</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="title__for-you">Gợi ý hôm nay</div>
        <div class="row product__list">
            @php
                $witems = Cart::instance('wishlist')
                    ->content()
                    ->pluck('id');
            @endphp
            @foreach ($products as $product)
                <div class="col l-2 m-3 c-6 product__item">
                    <div class="product__item-link">
                        @if ($witems->contains($product->id))
                            <button wire:click.prevent="removeFromWishlist({{ $product->id }})"
                                class="favorite-btn clicked"><i class="fas fa-heart"></i></button>
                        @else
                            <button
                                wire:click.prevent="addToWishlist({{ $product->id }},'{{ $product->name }}',{{ $product->regular_price }})"
                                class="favorite-btn"><i class="fas fa-heart"></i></button>
                        @endif
                        <a href="{{ Route('product.details', ['slug' => $product->slug]) }}">
                            <img src="{{ asset('assets/imgs/products') }}/{{ $product->image }}" alt=""
                                class="product__img">
                            <div class="product__name">{{ $product->name }}
                            </div>
                            <div class="product__group">
                                <div class="product__price">
                                    @if ($product->sale_price > 0)
                                        {{ number_format($product->sale_price, 0) }}
                                    @else
                                        {{ number_format($product->regular_price, 0) }}
                                    @endif
                                    <span class="copper">đ</span>
                                </div>
                                {{-- <div class="product__assess">5<i class="fa-solid fa-star"></i></i></div> --}}
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
        {{-- <div class="see-more"><a href="/shop" class="see-more__link btn-pink">Xem thêm</a></div> --}}
        <div class="see-more"><button wire:click='loadMore' class="see-more__link btn-pink">Xem thêm</button></div>
    </div>
</div>
