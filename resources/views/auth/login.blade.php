{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}
<x-guest-layout>
    <div class="row no-gutters login">
        <div class="col l-7 login__left">
            <img class="login__left-img" src="{{ asset('assets/imgs/icon/kidslandlogin.png') }}" alt="">
        </div>
        <div class="col l-5 login__right">
            <a href="/" class="home__link">Trang chủ</a>
            <h1 class="login__right-title">Đăng nhập</h1>
            <p class="login__right-text">
                Don't have an account? <a class="login__right-link" href="{{ route('register') }}"> Creat Your Account</a> it takes less
                than a minute
            </p>
            <x-jet-validation-errors class="mb-4 pl-50" />
            <form action="{{route('login')}}" class="login__right-form" method="POST">
                @csrf
                <div class="login__right-group">
                    <input class="login__right-input" type="email" id="email" name="email" :value="old('email')" required autofocus>
                    <span class="login__right-bar"></span>
                    <label class="login__right-label">Email</label>
                </div>
                <div class="login__right-group">
                    <input class="login__right-input" type="password" name="password" required autocomplete="current-password">
                    <span class="login__right-bar"></span>
                    <label class="login__right-label">Password</label>
                </div>
                <div class="login__remember">
                    <label for="remember" class="login__right-remembers">
                        <input id="remember" type="checkbox" class="login__right-remember" name="remember">
                        <span class="remember">Lưu mật khẩu</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="forget-password">Quên mật khẩu ?</a>
                </div>
                <button class="login-btn" type="submit">Đăng nhập</button>
            </form>

        </div>
    </div>
</x-guest-layout>
