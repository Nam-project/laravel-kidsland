<div class="main__content">
    <div class="grid wide">
        <div class="checkout-title">
            <a href="/" class="checkout-link">Home</a>
            <a href="{{ route('user.orders') }}" class="checkout-link">Đơn hàng của tôi</a>
            <span>Chi tiết đơn hàng</span>
        </div>
        <div class="row">
            <div class="col l-3 ">
                <div class="order__user">
                    <img src="{{ asset('assets/imgs/user.png') }}" alt="" class="order__user-img">
                    <div class="order__user-group">
                        <span>Tài khoản của</span>
                        <div class="order__user-name">{{ Auth::user()->name }}</div>
                    </div>
                </div>
                <ul class="order__nav">
                    <li><a href="">Thông tin tài khoản</a></li>
                    <li><a href="" class="order__nav-active">Quản lý đơn hàng</a></li>
                </ul>
            </div>
            <div class="col l-9 ">
                <div class="order-title">
                    Chi tiết đơn hàng
                </div>
                <div class="orderdetail__main">
                    <div class="order__tracking">
                        <div class="order__tracking-spoint"><span class="point-style"><i
                                    class="fa-solid fa-check"></i></span></div>
                        @if ($order->transaction->status == 'approved')
                            <div class="order__tracking-point"><span class="point-style"><i
                                        class="fa-solid fa-check"></i></span></div>
                        @endif
                        @if ($order->status == 'shipping' || $order->status == 'delivered')
                            <div class="order__tracking-point"><span class="point-style"><i
                                        class="fa-solid fa-check"></i></span></div>
                        @else
                            <div class="order__tracking-pointf"><span class="point-default"><i
                                        class="fa-regular fa-circle"></i></span></div>
                        @endif
                        @if ($order->status == 'delivered')
                            <div class="order__tracking-point"><span class="point-style"><i
                                        class="fa-solid fa-check"></i></span></div>
                        @else
                            <div class="order__tracking-pointf"><span class="point-default"><i
                                        class="fa-regular fa-circle"></i></span></div>
                        @endif
                    </div>
                    <div class="order__tracking-infor">
                        <div class="order__tracking-group">
                            <img src="{{ asset('assets/imgs/icon/order-icon.png') }}" alt=""
                                class="order__tracking-img">
                            <div class="order__tracking-text">Đơn hàng đã đặt</div>
                            <div class="order__tracking-date">{{ $order->created_at }}</div>
                        </div>
                        @if ($order->transaction->status == 'approved')
                            <div class="order__tracking-group">
                                <img src="{{ asset('assets/imgs/icon/credit-card.png') }}" alt=""
                                    class="order__tracking-img">
                                <div class="order__tracking-text">Đã thanh toán</div>
                                <div class="order__tracking-date">{{ $order->created_at }}</div>
                            </div>
                        @endif
                        <div class="order__tracking-group">
                            <img src="{{ asset('assets/imgs/icon/enroute-icon.png') }}" alt=""
                                class="order__tracking-img">
                            <div class="order__tracking-text">Đang giao</div>
                            <div class="order__tracking-date">{{ $order->shipping_date }}</div>
                        </div>
                        <div class="order__tracking-group">
                            <img src="{{ asset('assets/imgs/icon/arrived-icon.png') }}" alt=""
                                class="order__tracking-img">
                            <div class="order__tracking-text">Giao hàng thành công</div>
                            @if ($order->status == 'delivered')
                                <div class="order__tracking-date">{{ $order->delivered_date }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="order__detail-including">
                        <div class="order__detail-title">Kiện hàng gồm:</div>
                        @foreach ($order->detailOrder as $item)
                            <div class="order__item-products row no-gutters">
                                <div class="order__item-image col l-2">
                                    <img src="{{ asset('assets/imgs/products') }}/{{ $item->product->image }}"
                                        alt="{{ $item->product->name }}" class="order__item-img">
                                </div>
                                <div class="order__item-infor col l-8">
                                    <div class="order__item-name">{{ $item->product->name }}</div>
                                    <span class="order__item-quantity">Số lượng: {{ $item->count }}</span>
                                </div>
                                <div class="order__item-price col l-2">
                                    {{ number_format($item->price, 0) }} <span class="copper">đ</span>
                                </div>
                            </div>
                        @endforeach
                        <div class="order__item-footer">
                            <div class="order__item-total">Tổng tiền:
                                <span>{{ number_format($order->total, 0) }} <span class="copper">đ</span></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
