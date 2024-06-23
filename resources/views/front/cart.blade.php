<x-front-layout title='cart'>

<x-slot:breadcrumbs  >

    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Cart</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="{{ route('product.all') }}">Shop</a></li>
                        <li> Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
 </x-slot:breadcrumbs>


<!-- Shopping Cart -->
<div class="shopping-cart section">
    <div class="container">
        <div class="cart-list-head">
            <!-- Cart List Title -->
            <div class="cart-list-title">
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-12">

                    </div>
                    <div class="col-lg-4 col-md-3 col-12">
                        <p>Product Name</p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <p>Quantity</p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <p>Subtotal</p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <p>Discount</p>
                    </div>
                    <div class="col-lg-1 col-md-2 col-12">
                        <p>Remove</p>
                    </div>
                </div>
            </div>
            <!-- End Cart List Title -->

            @foreach ($cart as $items )

               <!-- Cart Single List list -->
            <div class="cart-single-list" id="{{ $items->id }}" >
                <div class="row align-items-center">
                    <div class="col-lg-1 col-md-1 col-12">
                        <a href="{{ route('product.show',$items->product->slug) }}"><img src="{{ $items->product->image_path }}" alt="{{$items->product->name}}"></a>
                    </div>
                    <div class="col-lg-4 col-md-3 col-12">
                        <h5 class="{{ $items->product->name }}"><a href="{{ route('product.show',$items->product->slug) }}">
                                {{ $items->product->name }}</a></h5>
                        <p class="product-des">
                            <span><em>Type:</em> Mirrorless</span>
                            <span><em>Color:</em> Black</span>
                        </p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <div class="count-input">
                            <input class="form-control item-quantity" data-id="{{ $items->id }}" value="{{ $items->quantity }}">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <p>{{currency::format( ($items->quantity * $items->product->price)+$items->product->compare_price)}}</p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <p>{{ currency::format( $items->product->compare_price) }}</p>
                    </div>
                    <div class="col-lg-1 col-md-2 col-12">
                        <form action="{{ route('cart.destroy', $items->id) }}" method="post" style="display : inline-block">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                        </form><!-- end of form -->
                        {{-- <a class="remove-item" data-id="{{ $items->id }}" href="{{ route('cart.destroy',$items->id) }}"><i class="lni lni-close"></i></a> --}}
                    </div>
                </div>
            </div>
            <!-- End Single List list -->

            @endforeach


        </div>
        <div class="row">
            <div class="col-12">
                <!-- Total Amount -->
                <div class="total-amount">
                    <div class="row">
                        <div class="col-lg-8 col-md-6 col-12">
                            <div class="left">
                                <div class="coupon">
                                    <form action="#" target="_blank">
                                        <input name="Coupon" placeholder="Enter Your Coupon">
                                        <div class="button">
                                            <button class="btn">Apply Coupon</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="right">
                                <ul>
                                    <li>Cart Subtotal<span>{{currency::format( $Cart_Subtotal)}}</span></li>
                                    <li>Shipping<span>Free</span></li>
                                    <li>You Save<span>{{ currency::format($sub_total )}}</span></li>
                                    <li class="last">You Pay<span>{{ currency::format($total) }}</span></li>
                                </ul>
                                <div class="button">
                                    <a href="checkout.html" class="btn">Checkout</a>
                                    <a href="product-grids.html" class="btn btn-alt">Continue shopping</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--/ End Total Amount -->
            </div>
        </div>
    </div>
</div>
<!--/ End Shopping Cart -->



@push('scripts')

    <script> const csrf_token ="{{ csrf_token() }}"; </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/Cart/cart.js') }}"></script>

 @endpush


</x-front-layout>
