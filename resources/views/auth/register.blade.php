{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
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
            <h1 class="login__right-title">Đăng ký</h1>

            <x-jet-validation-errors class="mb-4 pl-50" />
            <form action="{{ route('register') }}" class="login__right-form" method="POST">
                @csrf
                <div class="login__right-group">
                    <input class="login__right-input" id="name" type="name" name="name"
                        :value="old('name')" required autofocus autocomplete="name">
                    <span class="login__right-bar"></span>
                    <label class="login__right-label">Name</label>
                </div>
                <div class="login__right-group">
                    <input class="login__right-input" id="email" type="email" name="email"
                        :value="old('email')" required>
                    <span class="login__right-bar"></span>
                    <label class="login__right-label">Email</label>
                </div>
                <div class="login__right-group">
                    <input class="login__right-input" id="password" type="password" name="password" required
                        autocomplete="new-password">
                    <span class="login__right-bar"></span>
                    <label class="login__right-label">Password</label>
                </div>
                <div class="login__right-group">
                    <input class="login__right-input" id="password_confirmation" type="password"
                        name="password_confirmation" required autocomplete="new-password">
                    <span class="login__right-bar"></span>
                    <label class="login__right-label">Confirm Password</label>
                </div>
                <div class="login__account-group">
                    <a href="{{route('login')}}" class="login__account-have">Đã có tài khoản ?</a>
                </div>
                <button class="login-btn" type="submit">Đăng ký</button>
            </form>

        </div>
    </div>
</x-guest-layout>
