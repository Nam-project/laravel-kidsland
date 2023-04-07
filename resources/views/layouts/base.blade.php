<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KidsLand</title>
    <link rel="shortcut icon" href="{{asset('assets/imgs/2.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/normalize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/grid.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    @livewireStyles
</head>

<body>
    <div class="main">
        <header class="header">
            <div class="grid wide">
                <div class="header-with-search">
                    <div class="logo">
                        <div class="logo-additional"></div>
                        <div class="logo__i">
                            <a href="/"><img class="logo__img" src="{{ asset('assets/imgs/1.png') }}"
                                    alt=""></a>
                        </div>
                    </div>
                    <div class="search">
                        <div class="search-ip">
                            <input type="text" class="search__input" placeholder="Bố mẹ tìm gì cho bé hôm nay ?">
                            <button class="search__btn"><i
                                    class="fa-solid search__icon fa-magnifying-glass"></i></button>
                        </div>
                        <div class="search-more">

                        </div>
                    </div>
                    <div class="with-login-register">
                        {{-- <div class="login-register">
                            <a href="" class="loginr">Đăng Ký</a>
                            <a href="" class="loginr">Đăng Nhập</a>
                        </div>
                        <div class="login-success">
                            <div class="login-success__link">
                                <img src="assets/imgs/user.png" alt="" class="login-success__img">
                                <div class="login-success__name">Năm nguyễn</div>
                                <i class="fa-solid fa-caret-down login-success__icon"></i>
                                <ul class="login-success-plus">
                                    <li class="login-success-plus__i"><a href="">Thông tin tài khoản</a></li>
                                    <li class="login-success-plus__i"><a href="">Đơn hàng của tôi</a></li>
                                    <li class="login-success-plus__i"><a href="">Đăng xuất</a></li>
                                </ul>
                            </div>
                        </div> --}}
                        @auth
                            @if (Auth::user()->utype === 'ADM')
                                <div class="login-success">
                                    <div class="login-success__link">
                                        <img src="assets/imgs/user.png" alt="" class="login-success__img">
                                        <div class="login-success__name">{{ Auth::user()->name }}</div>
                                        <i class="fa-solid fa-caret-down login-success__icon"></i>
                                        <ul class="login-success-plus">
                                            <li class="login-success-plus__i"><a
                                                    href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                            <li class="login-success-plus__i"><a
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                    href="{{ route('logout') }}">Đăng xuất</a></li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                            </form>
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="login-success">
                                    <div class="login-success__link">
                                        <img src="assets/imgs/user.png" alt="" class="login-success__img">
                                        <div class="login-success__name">{{ Auth::user()->name }}</div>
                                        <i class="fa-solid fa-caret-down login-success__icon"></i>
                                        <ul class="login-success-plus">
                                            <li class="login-success-plus__i"><a href="{{ route('user.dashboard') }}">Thông
                                                    tin tài khoản</a></li>
                                            <li class="login-success-plus__i"><a href="/cart">Đơn hàng của tôi</a></li>
                                            <li class="login-success-plus__i"><a
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                    href="{{ route('logout') }}">Đăng xuất</a></li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                            </form>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="login-register">
                                <a href="{{ route('register') }}" class="loginr">Đăng Ký</a>
                                <a href="{{ route('login') }}" class="loginr">Đăng Nhập</a>
                            </div>
                            @endif
                            <div class="cart">
                                <a href="/cart" class="cart__icon"><i class="fa-solid fa-cart-shopping"><span
                                            class="cart__number">
                                            @if (Cart::count() > 0)
                                                {{ Cart::count() }}
                                            @else
                                                0
                                            @endif
                                        </span></i></a>
                            </div>
                        </div>
                    </div>
                    {{-- <nav class="header__nav">
                        <div class="header__nav--menu">
                            <i class="fa-solid menu-icon fa-bars"></i>
                            <div class="menu-text">Danh mục</div>
                        </div>
                    </nav> --}}
                    <nav class="nav__bar">
                        <ul class="nav__bar-group row">
                            <li class="nav__bar-item col l-2"><a href="/shop" class="nav__bar-link"><i class="fa-solid fa-shop"></i><span>Shop</span></a></li>
                            <li class="nav__bar-item col l-2"><a href="" class="nav__bar-link"><i class="fa-solid fa-phone"></i><span>Liên hệ</span></a></li>
                            <li class="nav__bar-item col l-2"><a href="" class="nav__bar-link"><i class="fa-brands fa-slack"></i><span>Góp ý</span></a></li>
                            <li class="nav__bar-item col l-2"><a href="" class="nav__bar-link"><i class="fa-solid fa-circle-question"></i><span>Hổ trợ</span></a></li>
                            <li class="nav__bar-item col l-2"><a href="" class="nav__bar-link"><i class="fa-solid fa-comments"></i><span>Chat</span></a></li>
                            <li class="nav__bar-item col l-2"><a href="" class="nav__bar-link"><i class="fa-solid fa-globe"></i><span>Cộng đồng</span></a></li>
                        </ul>
                    </nav>
                </div>
                
                
        </header>

            {{ $slot }}


            <footer class="footer">
                <div class="grid wide">
                    <a href="/" class="footer__link">
                        <img src="{{ asset('assets/imgs/1.png') }}" alt="" class="footer__logo">
                    </a>
                    <div class="row">
                        <div class="col l-4">
                            <h1 class="footer__title">KidsLand</h1>
                            <ul class="footer__list">
                                <li class="footer-item"> <a href="" class="footer-item-link">Giới thiệu</a></li>
                                <li class="footer-item"> <a href="" class="footer-item-link">Hệ thống cửa hàng</a>
                                </li>
                                <li class="footer-item"> <a href="" class="footer-item-link">Chính sách bảo mật</a>
                                </li>
                                <li class="footer-item"> <a href="" class="footer-item-link">Điều khoản sử
                                        dụng</a></li>
                            </ul>
                        </div>
                        <div class="col l-4">
                            <h1 class="footer__title">Hỗ trợ khách hàng</h1>
                            <ul class="footer__list">
                                <li class="footer-item"> <a href="" class="footer-item-link">Giới thiệu</a></li>
                                <li class="footer-item"> <a href="" class="footer-item-link">Hệ thống cửa hàng</a>
                                </li>
                                <li class="footer-item"> <a href="" class="footer-item-link">Chính sách bảo
                                        mật</a></li>
                                <li class="footer-item"> <a href="" class="footer-item-link">Điều khoản sử
                                        dụng</a></li>
                            </ul>
                        </div>
                        <div class="col l-4">
                            <h1 class="footer__title">Kết nối với chúng tôi</h1>
                            <div class="icon__group">
                                <a href="" class="footer__icon"><img
                                        src="{{ asset('assets/imgs/icon/facebook.png') }}" alt=""></a>
                                <a href="" class="footer__icon"><img
                                        src="{{ asset('assets/imgs/icon/twitter.png') }}" alt=""></a>
                                <a href="" class="footer__icon"><img
                                        src="{{ asset('assets/imgs/icon/youtube.png') }}" alt=""></a>
                                <a href="" class="footer__icon"><img
                                        src="{{ asset('assets/imgs/icon/instagram.png') }}" alt=""></a>

                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
        @livewireScripts
    </body>

    </html>
