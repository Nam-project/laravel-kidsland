<div class="main__content">
    <div class="grid wide">
        <div class="details">
            <div class="product__breadcrumb">
                <a href="">Trang chủ</a><i class="fa-solid fa-angle-right"></i>
                <a href="">Sửa bôt cao cấp</a><i class="fa-solid fa-angle-right"></i>
                <span>Sữa dê Bubs Goat số 3 800g (12-36 tháng)</span>
            </div>
            <div class="row details__group">
                <div class="col l-5 c-12 m-12 details__g-img">
                    <swiper-container style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                        class="mySwiper" thumbs-swiper=".mySwiper2" space-between="10">
                        <swiper-slide>
                            <img class="details__img" src="{{ asset('assets/imgs/products/' . $product->image) }}" />
                        </swiper-slide>
                        @php
                            $images = explode(',', $product->images);
                        @endphp
                        @foreach ($images as $image)
                            @if ($image)
                                <swiper-slide>
                                    <img class="details__img" src="{{ asset('assets/imgs/products/' . $image) }}" />
                                </swiper-slide>
                            @endif
                        @endforeach
                    </swiper-container>

                    <swiper-container class="mySwiper2" space-between="10" slides-per-view="4" free-mode="true"
                        watch-slides-progress="true" navigation="true">
                        <swiper-slide>
                            <img class="details__img-group" src="{{ asset('assets/imgs/products/' . $product->image) }}" />
                        </swiper-slide>
                        @foreach ($images as $image)
                            @if ($image)
                                <swiper-slide>
                                    <img class="details__img-group" src="{{ asset('assets/imgs/products/' . $image) }}" />
                                </swiper-slide>
                            @endif
                        @endforeach
                    </swiper-container>
                </div>
                <div class="col l-7 c-12 m-12">
                    <div class="details__name">{{ $product->name }}</div>
                    <div class="details__group-evaluate">
                        <div class="star__evaluate">
                            <span>5.0</span>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="star__evaluate"><span>255</span>
                            <div class="star__evaluate-text">Đánh giá</div>
                        </div>
                        <div class="details__sold">
                            <div>255</div>
                            <div class="star__evaluate-text">Đã bán</div>
                        </div>
                    </div>
                    <div class="details__price">{{ $product->sale_price }}<span class="copper">đ</span></div>
                    <div class="details__quantity">
                        <div class="details__quantity-text">Số lượng</div>
                        <div class="details__quantity-add">
                            <button class="minus-btn" wire:click.prevent="decreseQuantity" type="button">-</button>
                            <input type="number" min="1" max="{{ $product->quantity }}" value="1"
                                wire:model="qty" class="details__quantity-input">
                            <button class="plus-btn" wire:click.prevent="increaseQuantity" type="button">+</button>
                        </div>
                        <div class="details__quantity-text">{{ $product->quantity }} sản phẩm có sẵn</div>
                    </div>
                    <div class="details__cart">
                        <button class="details__cart-add"
                            wire:click.prevent="store({{ $product->id }},'{{ $product->name }}',{{ $product->regular_price }})"><i
                                class="fa-solid fa-cart-plus"></i>Thêm vào giỏ
                            hàng</button>
                        <button class="details__cart-buy">Mua ngay</button>
                    </div>
                </div>
            </div>
            <div class="row  details__information">
                <div class="col l-9 details__information-groups">
                    <div class="details__information-group">
                        <div class="details__information-title">
                            <div onclick="scrollToElement('target-element')" class="information__text text__active">Chi
                                tiết sản phẩm</div>
                            <div class="information__text"><a href="#evaluate">Đánh giá</a></div>
                            <div class="information__text">Thảo luận & hỏi đáp</div>
                        </div>
                    </div>
                    <table class=details__table>
                        <tr>
                            <td>Tên sản phẩm</td>
                            <td>Thực phẩm bổ sung: Thức uống dinh dưỡng Enfagrow Premium Toddler Nutritional</td>
                        </tr>
                        <tr>
                            <td class="td__01">Thương hiệu</td>
                            <td>Mead Johnson</td>
                        </tr>
                        <tr>
                            <td class="td__01">Xuất xứ thương hiệu</td>
                            <td>Hoa kỳ</td>
                        </tr>
                        <tr>
                            <td class="td__01">Độ tuổi phù hợp</td>
                            <td>{{ $productdetail->suitable_age }}</td>
                        </tr>
                        <tr>
                            <td class="td__01">Trọng lượng sản phẩm</td>
                            <td>{{ $productdetail->size }}</td>
                        </tr>
                        <tr>
                            <td class="td__01">Hướng dẫn sử dụng</td>
                            <td>{!! $productdetail->user_manual !!}</td>
                        </tr>
                        <tr>
                            <td class="td__01">Hướng dẫn bảo quản</td>
                            <td>{!! $productdetail->preserve !!}</td>
                        </tr>
                    </table>
                    <div class="details__describe">
                        {!! $product->description !!}
                    </div>

                </div>
                <div class="col l-3 products-relate">
                    <div class="row product__list">
                        @foreach ($related_products as $r_product)
                            <div class="col l-12 c-12 m-12 product__item">
                                <div class="product__item-link">
                                    <a href="{{ Route('product.details', ['slug' => $r_product->slug]) }}">
                                        <img src="{{ asset('assets/imgs/products/' . $r_product->image) }}"
                                            alt="{{ $r_product->name }}" class="product__img">
                                        <div class="product__name">{{ $r_product->name }}
                                        </div>
                                        <div class="product__group">
                                            <div class="product__price">{{ $r_product->sale_price }} <span
                                                    class="copper">đ</span></div>
                                            <div class="product__assess">5<i class="fa-solid fa-star"></i></i></div>
                                        </div>
                                    </a>
                                    <div class="product__with-cart">
                                        <a href="" class="product__buy-now btn-pink">Mua ngay</a>
                                        <a href="" class="product__cart">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div id="evaluate" class="details__evaluate row">
                <div class="details__evaluate-title col l-12">Đánh giá - Nhận xét<i
                        class="fa-solid fa-caret-right"></i></div>
                <div class="details__evaluate-rating col l-4">
                    <div class="review-rating__summary">
                        <div class="review-rating__point">4.3</div>
                        <div class="review-rating__stars">
                            <div class="review-rating__star" style="--rating: 4.3;"
                                aria-label="Rating of this product is 2.3 out of 5."></div>
                            <div class="review-rating__total">100 nhận xét</div>
                        </div>
                    </div>
                    <div class="review-rating__detail">
                        <div class="review-rating__level">
                            <div class="review-rating__group">
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                            </div>
                            <div class="review-rating__processbar">
                                <div class="rating__processbar-cushion" style="width: 80%;"></div>
                            </div>
                            <div class="review-rating__number">80</div>
                        </div>
                        <div class="review-rating__level">
                            <div class="review-rating__group">
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class=""><i class="fa-solid fa-star"></i></span>
                            </div>
                            <div class="review-rating__processbar">
                                <div class="rating__processbar-cushion" style="width: 10%;"></div>
                            </div>
                            <div class="review-rating__number">10</div>
                        </div>
                        <div class="review-rating__level">
                            <div class="review-rating__group">
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class=""><i class="fa-solid fa-star"></i></span>
                                <span class=""><i class="fa-solid fa-star"></i></span>
                            </div>
                            <div class="review-rating__processbar">
                                <div class="rating__processbar-cushion" style="width: 10%;"></div>
                            </div>
                            <div class="review-rating__number">10</div>
                        </div>
                        <div class="review-rating__level">
                            <div class="review-rating__group">
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class=""><i class="fa-solid fa-star"></i></span>
                                <span class=""><i class="fa-solid fa-star"></i></span>
                                <span class=""><i class="fa-solid fa-star"></i></span>
                            </div>
                            <div class="review-rating__processbar">
                                <div class="rating__processbar-cushion" style="width: 30%;"></div>
                            </div>
                            <div class="review-rating__number">30</div>
                        </div>
                        <div class="review-rating__level">
                            <div class="review-rating__group">
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class=""><i class="fa-solid fa-star"></i></span>
                                <span class=""><i class="fa-solid fa-star"></i></span>
                                <span class=""><i class="fa-solid fa-star"></i></span>
                                <span class=""><i class="fa-solid fa-star"></i></span>
                            </div>
                            <div class="review-rating__processbar">
                                <div class="rating__processbar-cushion" style="width: 5%;"></div>
                            </div>
                            <div class="review-rating__number">5</div>
                        </div>
                    </div>
                </div>

                <div class="details__evaluate-comment col l-8">
                    <div class="evaluate__comment-rating">
                        <a href="" class="evaluate__comment-avatar"><img src="../assets/imgs/user.png"
                                alt=""></a>
                        <div class="evaluate__comment-main">
                            <div class="evaluate__comment-username">Năm Nguyễn <span>08/04/2023</span></div>
                            <div class="evaluate__comment-star">
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                            </div>
                            <div class="evaluate__comment-text">
                                Đơn hàng được giao đúng hẹn, nguyên vẹn và sạch sẽ.
                            </div>
                        </div>
                    </div>
                    <div class="evaluate__comment-rating">
                        <a class="evaluate__comment-avatar"><img src="../assets/imgs/user.png" alt=""></a>
                        <div class="evaluate__comment-main">
                            <div class="evaluate__comment-username">Năm Nguyễn <span>08/04/2023</span></div>
                            <div class="evaluate__comment-star">
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                                <span class="star__active"><i class="fa-solid fa-star"></i></span>
                            </div>
                            <div class="evaluate__comment-text">
                                Đơn hàng được giao đúng hẹn, nguyên vẹn và sạch sẽ.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
