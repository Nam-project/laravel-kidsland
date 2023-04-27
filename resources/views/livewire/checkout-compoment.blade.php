<div class="main__content">
    <div class="grid wide">
        <div class="checkout-title">
            <a href="/" class="checkout-link">Home</a>
            <span>Thanh toán</span>
        </div>

        <div class="checkout-group">
            <div class="checkout-main">
                <div class="checkout-text">
                    <i class="fa-solid fa-location-dot"></i>
                    Địa chỉ nhận hàng
                </div>
                <form wire:submit.prevent="placeOrder"
                    class="checkout-form__address">
                    <div class="checkout__address-group">
                        <div class="checkout__address-name">
                            <label class="checkout__address-label" for="">Họ và tên:</label>
                            <input class="checkout__address-input" wire:model="name" type="text"
                                placeholder="Họ và tên">
                            @error('name')
                                <p class="checkout-error">{{ $message }}</p>
                            @enderror

                        </div>
                        <div class="checkout__address-name">
                            <label class="checkout__address-label" for="">Số điện thoại:</label>
                            <input class="checkout__address-input" wire:model="phone" type="number"
                                placeholder="Số điện thoại">
                            @error('phone')
                                <p class="checkout-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="checkout__address-group">
                        <div class="checkout__address-city">
                            <label class="checkout__address-label" for="">Thành phố:</label>
                            <select class="checkout__address-input" type="text" wire:model='city_id'
                                placeholder="Họ và tên">
                                <option value="" selected>Chọn thành phố</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->matp }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="checkout__address-city">
                            <label class="checkout__address-label" for="">Quận huyện:</label>
                            <select class="checkout__address-input" type="text" wire:model='province_id'
                                placeholder="Họ và tên">
                                <option value="" selected>Chọn quận huyện</option>
                                @if ($city_id)
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->maqh }}">{{ $province->name }}</option>
                                    @endforeach
                                @else
                                    <option value="">Vui lòng chọn thành phố</option>
                                @endif
                            </select>
                        </div>
                        <div class="checkout__address-city">
                            <label class="checkout__address-label" for="">Xã phường:</label>
                            <select class="checkout__address-input" type="text" wire:model="ward_id"
                                placeholder="Họ và tên">
                                <option value="" selected>Chọn xã phường</option>
                                @if ($province_id)
                                    @foreach ($wards as $ward)
                                        <option value="{{ $ward->xaid }}">{{ $ward->name }}</option>
                                    @endforeach
                                @else
                                    <option value="">Vui lòng chọn quận huyện</option>
                                @endif
                            </select>
                            @error('ward_id')
                                <p class="checkout-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="checkout__address-group">
                        <div class="checkout__address-name">
                            <label class="checkout__address-label" for="">Địa chỉ cụ thể:</label>
                            <input class="checkout__address-input" wire:model="address" type="text"
                                placeholder="Địa chỉ cụ thể">
                            @error('address')
                                <p class="checkout-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="checkout__address-group">
                        <label class="checkout__address-implement" for="check_save">Lưu thông tin</label>
                        <input type="checkbox" name="" id="check_save">
                    </div>
                    <div class="checkout__products">
                        <div class="checkout__products-title">Sản phẩm</div>
                        @foreach (Cart::instance('cart')->content() as $item)
                            <div class="checkout__products-item">
                                <img src="{{ asset('assets/imgs/products/' . $item->model->image) }}"
                                    alt="{{ $item->model->name }}" class="checkout__products-img">
                                <div class="checkout__products-name">{{ $item->model->name }}</div>
                                <div class="checkout__products-text"><span>Đơn
                                        giá:</span>{{ $item->price }}<span class="copper">đ</span>
                                </div>
                                <div class="checkout__products-text"><span>Số lượng:</span>{{ $item->qty }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="checkout__infor">
                        <div class="checkout__infor-title">
                            <h2 class="checkout__infor-text">Phương thức thanh toán</h2>

                        </div>
                        <div class="row">
                            <div class="col l-9 m-8 c-0">
                                <div class="checkout__infor-pay">
                                    <div class="checkout__infor-pay-group">
                                        <input type="radio" name="form" value="cod" wire:model="payment"
                                            class="checkout__pay-checkbox" id="paycheckbox1">
                                        <img src="{{ asset('assets/imgs/icon/pay-receive.png') }}"
                                            class="checkout__pay-icon" alt="">
                                        <label for="paycheckbox1" class="checkout__pay-label">Thanh toán khi nhận
                                            hàng</label>
                                    </div>
                                    <div class="checkout__infor-pay-group">
                                        <input type="radio" name="form" value="vnpay" wire:model="payment"
                                            class="checkout__pay-checkbox" id="paycheckbox2">
                                        <img src="{{ asset('assets/imgs/icon/vnpay-icon.png') }}"
                                            class="checkout__pay-icon" alt="">
                                        <label for="paycheckbox2" class="checkout__pay-label">Thanh toán bằng
                                            VNPAY</label>
                                    </div>
                                    <div class="checkout__infor-pay-group">
                                        <input type="radio" name="form" value="option3" wire:model="payment"
                                            class="checkout__pay-checkbox" id="paycheckbox3">
                                        <img src="{{ asset('assets/imgs/icon/momo-icon.jpg') }}"
                                            class="checkout__pay-icon" alt="">
                                        <label for="paycheckbox3" class="checkout__pay-label">Thanh toán bằng
                                            MOMO</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col l-3 m-4 c-12 checkout__infor-contain">
                                <div class="checkout__infor-contain-g">
                                    @if (Session::has('checkout'))
                                        <div class="checkout__infor-item">
                                            <div class="">Tổng tiền hàng:</div>
                                            <div class="checkout__infor-item-money">
                                                {{ Session::get('checkout')['subtotal'] }}<span
                                                    class="copper">đ</span> </div>
                                        </div>
                                        {{-- <div class="checkout__infor-item">
                                        <div class="">Phí vận chuyển:</div>
                                        <div class="">27.500 <span class="copper">đ</span> </div>
                                    </div> --}}
                                        {{-- <div class="checkout__infor-item">
                                            <div class="">Tổng thanh toán:</div>
                                            <div class="checkout__infor-item-money">27.500 <span class="copper">đ</span>
                                            </div>
                                        </div> --}}
                                    @endif
                                    <button class="btn__checkout">Đặt hàng</button>

                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
