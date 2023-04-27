<div class="main__content">
    <div class="grid wide">
        <div class="checkout-title">
            <a href="/" class="checkout-link">Home</a>
            <span>Đơn hàng của tôi</span>
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
                    Đơn hàng của tôi
                </div>
                <div class="order__main">
                    @if (count($orders) > 0)
                        <table class="order-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Số ĐT</th>
                                    <th>Giảm giá</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đặt</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->user->email }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->discount }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td><a class="btn-orderdetails"
                                                href="{{ route('user.orderdetails', ['order_id' => $order->id]) }}">Chi
                                                tiết</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @else
                        <div class="cart-empty">
                            <img src="{{asset('assets/imgs/icon/ecommerce.png')}}" alt=""
                                class="img-cart-drum">
                            <h2 class="cart-empty-title">Chưa có đơn hàng</h2>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
