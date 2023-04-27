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
                <div class="order__main">
                    <div class="checkout__products">
                        <div class="checkout__products-title">Sản phẩm</div>
                        @foreach ($order->detailOrder as $item)
                            <div class="checkout__products-item">
                                <img src="{{ asset('assets/imgs/products') }}/{{ $item->product->image }}"
                                    alt="{{ $item->product->name }}" class="checkout__products-img">
                                <div class="checkout__products-name">{{ $item->product->name }}</div>
                                <div class="checkout__products-text"><span>Đơn
                                        giá:</span>{{ $item->price }}<span class="copper">đ</span>
                                </div>
                                <div class="checkout__products-text"><span>Số lượng:</span>{{ $item->count }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="cart__order">
                        <div class="summary-info"><span>Giảm giá</span>
                            <p>{{$order->discount}}<span class="copper">đ</span></p>
                        </div>
                        <div class="summary-info"><span>Vận chuyển</span>
                            <p>Freeship</p>
                        </div>
                        <div class="summary-info"><span>Tổng thanh toán</span>
                            <p>{{$order->total}}<span class="copper">đ</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
