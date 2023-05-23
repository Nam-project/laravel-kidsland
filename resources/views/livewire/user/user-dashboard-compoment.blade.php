<div class="main__content">
    <div class="grid wide">
        <div class="checkout-title">
            <a href="/" class="checkout-link">Home</a>
            <span>Thông tin tài khoản</span>
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
                    <li><a href="" class="order__nav-active">Thông tin tài khoản</a></li>
                    <li><a href="{{ route('user.orders') }}">Quản lý đơn hàng</a></li>
                </ul>
            </div>
            <div class="col l-9 ">
                <div class="order-title">
                    Thông tin tài khoản
                </div>
                <div class="profile row no-gutters">
                    <div class="col l-7">
                        <div class="profile-title">Thông tin cá nhân</div>
                        <div class="profile__form">
                            <div class="profile__form-info">
                                <a class="profile__form-link">
                                    <div class="profile__form-avatar">
                                        <img class="profile__form-img" src="{{ asset('assets/imgs/user.png') }}"
                                            alt="">
                                    </div>
                                    <span class="profile__form-icon">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </span>
                                </a>
                                <div class="profile__form-name">
                                    <label class="profile__form-label" for="">Họ & Tên</label>
                                    <input class="profile__form-input" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="profile__form-control">
                            <label class="profile__form-label" for="">Ngày sinh</label>
                            <input class="profile__form-input" type="date">
                        </div>
                        <div class="profile__form-control">
                            <label class="profile__form-label" for="">Giới tính</label>
                            <div class="profile__form-group">
                                <div class="profile__form-sex">
                                    <input type="radio" name="sex" id="male">
                                    <label for="male">Nam</label>
                                </div>
                                <div class="profile__form-sex">
                                    <input type="radio" name="sex" id="female">
                                    <label for="female">Nữ</label>
                                </div>
                                <div class="profile__form-sex">
                                    <input type="radio" name="sex" id="other">
                                    <label for="other">Khác</label>
                                </div>
                            </div>
                        </div>
                        <div class="profile__form-footer">
                            <button type="submit" class="profile__form-btn">Lưu thay đổi</button>
                        </div>
                    </div>
                    <div class="col l-5">
                        <div class="profile-title pl-10">Số điện thoại và email</div>
                        <div class="profile-group pl-10">
                            <div class="profile-item">
                                <div class="profile-item__icon">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div class="profile-item__group">
                                    <div>Số điện thoại</div>
                                    <div class="profile-item_phone">12345678</div>
                                </div>
                                <button class="profile-item__btn">Cập nhật</button>
                            </div>
                            <div class="profile-item">
                                <div class="profile-item__icon">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                                <div class="profile-item__group">
                                    <div>Địa chỉ email</div>
                                    <div class="profile-item_phone">qng.namnguyen@gmail.com
                                    </div>
                                </div>
                                <button class="profile-item__btn">Cập nhật</button>
                            </div>
                        </div>
                        <div class="profile-title pl-10">Bảo mật</div>
                        <div class="profile-item pl-10">
                            <div class="profile-item__icon">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <div class="profile-item__group">
                                <div>Thiết lập mật khẩu</div>
                            </div>
                            <button class="profile-item__btn">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
