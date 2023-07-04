<div class="main__content">
    <div class="grid wide">
        <div class="products__cart">
            {{-- <div class="products__cart-title">Giỏ hàng</div> --}}
            {{-- @if (Session::has('success_message'))
                <h3>{{Session::get('success_message')}}</h3>
            @endif --}}
            @if (Cart::instance('cart')->count() > 0)
                <div class="cart__header">
                    <div class="cart__header--products"><span>Sản
                            phẩm</span></div>
                    <div class="cart__header--item">Đơn giá</div>
                    <div class="cart__header--item">Số lượng</div>
                    <div class="cart__header--item">Thành tiền</div>
                    <div class="cart__header--item">Thao tác</div>
                </div>
                <div class="products__cart-group">
                    @foreach (Cart::instance('cart')->content() as $item)
                        <div class="products__cart-item">
                            <div class="products__cart-i">

                                <a href="{{ route('product.details', ['slug' => $item->model->slug]) }}">
                                    <img src="{{ asset('assets/imgs/products/' . $item->model->image) }}"
                                        alt="{{ $item->model->name }}" class="product__cart-img">
                                    <div class="product__cart-name">{{ $item->model->name }}</div>
                                </a>
                            </div>
                            <div class="products__cart-other">{{ $item->price }} <span
                                    class="copper">đ</span></div>
                            <div class="products__cart-other">
                                <div class="details__quantity-add">
                                    <button class="minus-btn"
                                        wire:click.prevent="decreaseQuantity('{{ $item->rowId }}')"
                                        type="button">-</button>
                                    <input type="number" min="1" max="{{ $item->model->quantity }}"
                                        value="{{ $item->qty }}" class="details__quantity-input">
                                    <button class="plus-btn"
                                        wire:click.prevent="increaseQuantity('{{ $item->rowId }}')"
                                        type="button">+</button>
                                </div>
                            </div>
                            <div class="products__cart-other">{{ $item->price }} <span
                                    class="copper">đ</span></div>
                            <div class="products__cart-other">
                                <button class="cart-btn-delete"
                                    wire:click.prevent="destroy('{{ $item->rowId }}')">Xóa</button>
                            </div>

                        </div>
                    @endforeach
                </div>
                <div class="cart__order">
                    @if (!Session::has('coupon'))
                        <div class="summary-info"><span></span><input type="checkbox" class="check__coupon-cart"
                                value="1" name="" id="check_coupon" wire:model="coupon_code"><label
                                for="check_coupon" class="cart__order-coupon">Chọn hoặc nhập mã khuyến mãi</label></div>
                        @if ($coupon_code == 1)
                            <label for="check_coupon" class="coupon__cart-cushion"></label>
                            <div class="coupon__cart-form">
                                <div class="coupon__cart-title"><span>Chọn khuyến mãi</span><label
                                        class="coupon__cart-close " for="check_coupon"><i
                                            class="fa-solid fa-xmark"></i></label></div>
                                <form wire:submit.prevent="applyCouponCode" class="coupon__cart-group">
                                    <span class="coupon__cart-text">CODE</span> 
                                    <input type="text" class="coupon__cart-input" wire:model="couponCode">
                                    <button class="coupon__cart-apply">ÁP DỤNG</button>
                                </form>
                                @if (Session::has('coupon_massage'))
                                    <p class="coupon-error">{{ Session::get('coupon_massage') }}</p>
                                @endif
                                <div class="coupon__cart-list">
                                    @foreach ($coupons as $coupon)
                                        <div class="coupon__cart-item">
                                            <div class="coupon__item-left">
                                                <div class="coupon__item-promotion">{{$coupon->type == 'fixed'? substr($coupon->value, 0, -3):$coupon->value}}{{$coupon->type == 'fixed'?'K':'%'}}</div>
                                            </div>
                                            <div class="coupon__item-right">
                                                <div class="coupon__item-title">{{$coupon->code}}</div>
                                                <button class="coupon__item-btn" wire:click.prevent='applyCoupon({{$coupon->id}})'>Chọn</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif
                    <div class="summary-info"><span>Tạm tính</span>
                        <p>{{ Cart::instance('cart')->subtotal() }} <span class="copper">đ</span></p>
                    </div>
                    @if (Session::has('coupon'))
                        <div class="summary-info">
                            <div class="summary-info__group"><span>Giảm giá</span> <button class="delete__coupon"
                                    wire:click.prevent="removeCoupon">{{ Session::get('coupon')['code'] }}<i
                                        class="fa-solid fa-xmark"></i></button> </div>
                            <p>-{{ number_format($discount, 2) }} <span class="copper">đ</span></p>
                        </div>
                        <div class="summary-info"><span>Vận chuyển</span>
                            <p>Freeship</p>
                        </div>
                        <div class="summary-info"><span>Tổng thanh toán</span>
                            <p>{{ number_format($subtotalAfterDiscount, 2) }} <span class="copper">đ</span></p>
                        </div>
                    @else
                        <div class="summary-info"><span>Vận chuyển</span>
                            <p>Freeship</p>
                        </div>
                        <div class="summary-info"><span>Tổng thanh toán</span>
                            <p>{{ Cart::instance('cart')->total() }} <span class="copper">đ</span></p>
                        </div>
                    @endif
                    <div class="summary-info"><span></span><button wire:click.prevent="checkout"
                            class="cart__btn-buynow">Mua hàng</button></div>
                </div>
            @else
                <div class="cart-empty">
                    <img src="{{ asset('assets/imgs/icon/ecommerce.png') }}" alt="" class="img-cart-drum">
                    <h2 class="cart-empty-title">Giỏ hàng trống</h2>
                    <a href="/" class="cart-empty-btn btn-pink">Mua ngay</a>
                </div>
            @endif
        </div>
    </div>
</div>
