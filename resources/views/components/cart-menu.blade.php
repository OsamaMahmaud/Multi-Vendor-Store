<div class="cart-items">
    <a href="javascript:void(0)" class="main-btn">
        <i class="lni lni-cart"></i>
        <span class="total-items">{{ $items->count() }}</span>
    </a>
    <!-- Shopping Item -->
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{ $items->count() }} Items</span>
            <a href="{{ route('cart.index') }}">View Cart</a>
        </div>
        <ul class="shopping-list">

          @foreach($items as $item)

            <li>
                <a href="javascript:void(0)" class="remove" title="Remove this item"><i
                        class="lni lni-close"></i></a>
                <div class="cart-img-head">
                    <a class="cart-img" href="{{ route('product.show',$item->product->slug) }}"><img
                            src="{{$item->product->image_path}}" alt="#"></a>
                </div>

                <div class="content">
                    <h4><a href="{{ route('product.show',$item->product->slug) }}">
                            {{ $item->product->name }}</a></h4>
                    <p class="quantity">{{ $item->quantity }}x - <span class="amount">{{currency::format( $item->product->price )}}</span></p>
                </div>
            </li>

        @endforeach

        </ul>
        <div class="bottom">
            <div class="total">
                <span>Total</span>
                <span class="total-amount">{{ currency::format( $total ) }}</span>
            </div>
            <div class="button">
                <a href="checkout.html" class="btn animate">Checkout</a>
            </div>
        </div>
    </div>
    <!--/ End Shopping Item -->
</div>
