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
                <div class="order__navbar">
                    <div class="order__nav-item {{ $status == 'all' ? 'order__navbar-active' : '' }}"
                        wire:click.prevent="statusOrder('all')">Tất cả đơn</div>
                    <div class="order__nav-item {{ $status == 'ordered' ? 'order__navbar-active' : '' }}"
                        wire:click.prevent="statusOrder('ordered')">Đang xử lý</div>
                    {{-- <div class="order__nav-item">Đang vận chuyển</div> --}}
                    <div class="order__nav-item {{ $status == 'delivered' ? 'order__navbar-active' : '' }}"
                        wire:click.prevent="statusOrder('delivered')">Đã giao</div>
                    <div class="order__nav-item {{ $status == 'canceled' ? 'order__navbar-active' : '' }}"
                        wire:click.prevent="statusOrder('canceled')">Đã hủy</div>
                </div>
                <div class="order__main">
                    @if (count($orders) > 0)
                        @foreach ($orders as $key => $order)
                            <div class="order__item">
                                <div class="order__item-header">
                                    <div
                                        class="order__item-title {{ $order->status == 'shipping' ? 'text-blue' : '' }} {{ $order->status == 'ordered' ? 'text-lightblue' : '' }} {{ $order->status == 'canceled' ? 'text-pink' : '' }}">
                                        <i class="fa-solid fa-truck-moving"></i>
                                        <span>
                                            @switch($order->status)
                                                @case('delivered')
                                                    Giao hàng thành công
                                                @break

                                                @case('canceled')
                                                    Đã hũy
                                                @break

                                                @case('ordered')
                                                    Đang xữ lý
                                                @break

                                                @default
                                                    Đang giao hàng
                                            @endswitch
                                        </span>
                                    </div>
                                    <div class="order__item-title">
                                        <a href="{{ route('user.orderdetails', ['order_id' => $order->id]) }}"
                                            class="order__item-btn">Xem chi tiết</a>
                                    </div>
                                </div>
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
                                            {{ number_format($item->product->sale_price, 0) }} <span
                                                class="copper">đ</span>
                                            @if ($order->status == 'delivered' && $item->rstatus == false)
                                                <div class="ratting__checkout-group">
                                                    <label for="ratting_checkout" class="ratting__item-btn">Viết nhận
                                                        xét</label>
                                                </div>
                                                <input type="checkbox" class="ratting__item-checkout" value="1"
                                                    name="" wire:model="viewEvaluate" id="ratting_checkout">
                                                @if ($viewEvaluate == 1)
                                                    <label for="ratting_checkout" class="form-evaluate-cushion"></label>
                                                    <div class="form-evaluate">
                                                        <form wire:submit.prevent="addEvaluates({{$item->id}})">
                                                            <div class="form-evaluate-title"><span class="form-evaluate-span">Nhận xét</span><label
                                                                    for="ratting_checkout" class="close-evaluate"><i
                                                                        class="fa-solid fa-xmark"></i></label></div>
                                                            <div class='form-evaluate-stars'>
                                                                <input type="radio" name='stars' value='5'
                                                                    id='five' class='form-evaluate-star'
                                                                    wire:model="star">
                                                                <label class="star-label" for="five"><i
                                                                        class='evaluate-star-icon fa fa-star'></i></label>
                                                                <input type="radio" name='stars' value='4'
                                                                    id='four' class='form-evaluate-star'
                                                                    wire:model="star">
                                                                <label class="star-label" for="four"><i
                                                                        class='evaluate-star-icon fa fa-star'></i></label>
                                                                <input type="radio" name='stars' value='3'
                                                                    id='three' class='form-evaluate-star'
                                                                    wire:model="star">
                                                                <label class="star-label" for="three"><i
                                                                        class='evaluate-star-icon fa fa-star'></i></label>
                                                                <input type="radio" name='stars' value='2'
                                                                    id='two' class='form-evaluate-star'
                                                                    wire:model="star">
                                                                <label class="star-label" for="two"><i
                                                                        class='evaluate-star-icon fa fa-star'></i></label>
                                                                <input type="radio" name='stars' value='1'
                                                                    id='one' class='form-evaluate-star'
                                                                    wire:model="star">
                                                                <label class="star-label" for="one"><i
                                                                        class='evaluate-star-icon fa fa-star '></i></label>
                                                            </div>
                                                            <div class="form-evaluate-group">
                                                                <label class="form-evaluate-text">Nhận xét của bạn:</label>
                                                                <textarea class="form-evaluate-textarea" wire:model="content" name="" id="" cols="30"
                                                                    rows="10"></textarea>

                                                            </div>
                                                            <div class="form-evaluate-submit">

                                                                <button
                                                                    class="btn-evaluate evaluate-submit">Gữi</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                <div class="order__item-footer">
                                    <div class="order__item-total">Tổng tiền:
                                        <span>{{ number_format($order->total, 0) }} <span
                                                class="copper">đ</span></span>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="orders-empty">
                            <img src="{{ asset('assets/imgs/icon/empty-order.png') }}" alt=""
                                class="img-orders-empty">
                            <h2 class="cart-empty-title">Chưa có đơn hàng</h2>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
