<div class="main__content">
    <div class="grid wide">
        <div class="products__cart">
            {{-- <div class="products__cart-title">Giỏ hàng</div> --}}
            {{-- @if (Session::has('success_message'))
                <h3>{{Session::get('success_message')}}</h3>
            @endif --}}
            @if (Cart::count() > 0)
            <div class="cart__header">
                <div class="cart__header--products"><input type="checkbox" name="" id=""><span>Sản
                        phẩm</span></div>
                <div class="cart__header--item">Đơn giá</div>
                <div class="cart__header--item">Số lượng</div>
                <div class="cart__header--item">Thành tiền</div>
                <div class="cart__header--item">Thao tác</div>
            </div>
            <div class="products__cart-group">
                @foreach (Cart::content() as $item)
                    <div class="products__cart-item">
                        <div class="products__cart-i">
                            <input type="checkbox" name="" id="">
                            <a href="{{route('product.details',['slug'=>$item->model->slug])}}">
                                <img src="{{asset('assets/imgs/products/'.$item->model->image) }}" alt="{{$item->model->name}}"
                                    class="product__cart-img">
                                <div class="product__cart-name">{{$item->model->name}}</div>
                            </a>
                        </div>
                        <div class="products__cart-other">{{$item->model->regular_price}} <span class="copper">đ</span></div>
                        <div class="products__cart-other">
                            <div class="details__quantity-add">
                                <button class="minus-btn" wire:click.prevent="decreaseQuantity('{{$item->rowId}}')" type="button">-</button>
                                <input type="number" min="1" max="{{$item->model->quantity}}" value="{{$item->qty}}"
                                    class="details__quantity-input">
                                <button class="plus-btn" wire:click.prevent="increaseQuantity('{{$item->rowId}}')" type="button">+</button>
                            </div>
                        </div>
                        <div class="products__cart-other">{{$item->model->regular_price}} <span class="copper">đ</span></div>
                        <div class="products__cart-other">
                            <button class="cart-btn-delete" wire:click.prevent="destroy('{{$item->rowId}}')">Xóa</button>
                        </div>

                    </div>
                    
                @endforeach
                <div class="cart__order">
                    <div class="cart__order-title">Order Summary</div>
                    <div class="summary-info"><span>Subtotal</span><p>{{Cart::subtotal() }}</p></div>
                    <div class="summary-info"><span>Tax</span><p>{{Cart::tax()}}</p></div>
                    <div class="summary-info"><span>Shipping</span><p>Free shopping</p></div>
                    <div class="summary-info"><span>Total</span><p>{{Cart::total()}}</p></div>
                </div>
            </div>
            @else
                <div class="cart-empty">
                    <img src="{{asset('assets/imgs/icon/ecommerce.png')}}" alt="" class="img-cart-drum">
                    <h2 class="cart-empty-title">Giỏ hàng trống</h2>
                    <a href="/" class="cart-empty-btn btn-pink">Mua ngay</a>
                </div>
            @endif
        </div>
    </div>
</div>
