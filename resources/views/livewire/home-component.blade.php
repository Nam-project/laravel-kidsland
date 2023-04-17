<div class="main__content">
    <div class="grid wide">
        <div class="row no-gutters">
            <div class="col l-2 c-0 m-0 category__group">
                <ul class="category-list">
                    <div class="category__title"><i class="fa-solid fa-bars"></i>Danh mục</div>
                    @foreach ($category as $item)
                        <li class="category-item"><a href="{{ route('product.category', ['category_slug' => $item->slug]) }}"
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
                                                    href="">{{ $brand->name }}</a></li>
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
        <div class="flast-sale">
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
                <div class="col l-2 m-3 c-6 flast-sale__item">
                    <a href="" class="flast-sale__link">
                        <img src="{{ asset('assets/imgs/sua-enfagrow-premium.jpg') }}" alt=""
                            class="sale__item-img">
                        <div class="flast-sale__name">Sữa Enfagrow Premium Toddler Nutritional 907g (từ 1 tuổi)
                        </div>
                        <div class="flast-sale__price">
                            <div class="sale__price-old">800.000 <span class="copper">đ</span></div>
                            <div class="sale__price-new">735.000 <span class="copper">đ</span></div>
                        </div>
                    </a>
                </div>
                <div class="col l-2 m-3 c-6 flast-sale__item">
                    <a href="" class="flast-sale__link">
                        <img src="{{ asset('assets/imgs/thuc-pham-bo-sung-aptamil-2.jpg') }}" alt=""
                            class="sale__item-img">
                        <div class="flast-sale__name">Sữa Enfagrow Premium Toddler Nutritional 907g (từ 1 tuổi)
                        </div>
                        <div class="flast-sale__price">
                            <div class="sale__price-old">800.000 <span class="copper">đ</span></div>
                            <div class="sale__price-new">735.000 <span class="copper">đ</span></div>
                        </div>
                    </a>
                </div>
                <div class="col l-2 m-3 c-6 flast-sale__item">
                    <a href="" class="flast-sale__link">
                        <img src="{{ asset('assets/imgs/sua-enfagrow-premium.jpg') }}" alt=""
                            class="sale__item-img">
                        <div class="flast-sale__name">Sữa Enfagrow Premium Toddler Nutritional 907g (từ 1 tuổi)
                        </div>
                        <div class="flast-sale__price">
                            <div class="sale__price-old">800.000 <span class="copper">đ</span></div>
                            <div class="sale__price-new">735.000 <span class="copper">đ</span></div>
                        </div>
                    </a>
                </div>
                <div class="col l-2 m-3 c-6 flast-sale__item">
                    <a href="" class="flast-sale__link">
                        <img src="{{ asset('assets/imgs/thuc-pham-bo-sung-aptamil-2.jpg') }}" alt=""
                            class="sale__item-img">
                        <div class="flast-sale__name">Sữa Enfagrow Premium Toddler Nutritional 907g (từ 1 tuổi)
                        </div>
                        <div class="flast-sale__price">
                            <div class="sale__price-old">800.000 <span class="copper">đ</span></div>
                            <div class="sale__price-new">735.000 <span class="copper">đ</span></div>
                        </div>
                    </a>
                </div>
                <div class="col l-2 m-3 c-6 flast-sale__item">
                    <a href="" class="flast-sale__link">
                        <img src="{{ asset('assets/imgs/sua-enfagrow-premium.jpg') }}" alt=""
                            class="sale__item-img">
                        <div class="flast-sale__name">Sữa Enfagrow Premium Toddler Nutritional 907g (từ 1 tuổi)
                        </div>
                        <div class="flast-sale__price">
                            <div class="sale__price-old">800.000 <span class="copper">đ</span></div>
                            <div class="sale__price-new">735000 <span class="copper">đ</span></div>
                        </div>
                    </a>
                </div>
                <div class="col l-2 m-3 c-6 flast-sale__item">
                    <a href="" class="flast-sale__link">
                        <img src="{{ asset('assets/imgs/thuc-pham-bo-sung-aptamil-2.jpg') }}" alt=""
                            class="sale__item-img">
                        <div class="flast-sale__name">Sữa Enfagrow Premium Toddler Nutritional 907g (từ 1 tuổi)
                        </div>
                        <div class="flast-sale__price">
                            <div class="sale__price-old">800.000 <span class="copper">đ</span></div>
                            <div class="sale__price-new">735000 <span class="copper">đ</span></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="title__for-you">Gợi ý hôm nay</div>
        <div class="row product__list">
            @foreach ($products as $product)
                <div class="col l-2 m-3 c-6 product__item">
                    <div class="product__item-link">
                        <a href="{{ Route('product.details', ['slug' => $product->slug]) }}">
                            <img src="{{ asset('assets/imgs/products') }}/{{ $product->image }}" alt=""
                                class="product__img">
                            <div class="product__name">{{ $product->name }}
                            </div>
                            <div class="product__group">
                                <div class="product__price">{{ $product->regular_price }}<span
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
        {{-- <div class="see-more"><a href="/shop" class="see-more__link btn-pink">Xem thêm</a></div> --}}
        <div class="see-more"><button wire:click='loadMore' class="see-more__link btn-pink">Xem thêm</button></div>
    </div>
</div>
