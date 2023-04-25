<div class="cart">
    <a href="/cart" class="cart__icon">
        <i class="fa-solid fa-cart-shopping">
            <span class="cart__number">
                @if (Cart::instance('cart')->count() > 0)
                    {{ Cart::instance('cart')->count() }}
                @else
                    0
                @endif
            </span>
        </i>
    </a>
</div>
