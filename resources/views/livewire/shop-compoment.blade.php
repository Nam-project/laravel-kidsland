<div class="main__content">
    <div class="grid wide">
        <div class="row product__list">
            @foreach ($products as $product)
                <div class="col l-2 m-3 c-6 product__item">
                    <div class="product__item-link">
                        <a href="{{Route('product.details',['slug'=>$product->slug])}}">
                            <img src="{{asset('assets/imgs/products/'.$product->image)}}" alt="{{$product->name}}"
                                class="product__img">
                            <div class="product__name">{{$product->name}}
                            </div>
                            <div class="product__group">
                                <div class="product__price">{{$product->sale_price}} <span class="copper">đ</span></div>
                                <div class="product__assess">5<i class="fa-solid fa-star"></i></i></div>
                            </div>
                        </a>
                        <div class="product__with-cart">
                            <a href="" class="product__buy-now btn-pink">Mua ngay</a>
                            <button onclick="updateCartCount()" class="product__cart" wire:click.prevent="store({{$product->id}},'{{$product->name}}',{{$product->regular_price}})">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{$products->links('custom-pagination-links-view')}}
    </div>
</div>
