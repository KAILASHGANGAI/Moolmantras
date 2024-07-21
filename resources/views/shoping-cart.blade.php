@extends('layouts.app')
@section('content')
    @include('parts.nobanner-menu')
    <!-- Breadcrumb Section Begin -->
    {{-- <section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/images/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad ">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    @if (session()->get('cart'))
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Products</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    

                                    @foreach (session()->get('cart') as $cart)
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <a href="{{ route('showProduct', $cart['sku']) }}">
                                                    <img src="{{ asset($cart['image']) }}" alt="">
                                                    <h5>{{ $cart['name'] }}</h5>
                                                </a>
                                            </td>
                                            <td class="shoping__cart__price">
                                                Rs. {{ $cart['price'] }}
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <div class="pro-qty" data-product-id="{{ $cart['sku'] }}"  data-price="{{ $cart['price'] }}">
                                                        <input type="text" value="{{ $cart['quantity'] }}" min="1">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total">
                                                {{ $cart['quantity'] * $cart['price'] }}
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <a href="{{ route('cart.remove', $cart['sku']) }}">
                                                    <span class="icon_close"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach




                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center">
                            <h1>No Item on Cart</h1>
                            <a href="{{ route('products') }}" class="btn btn-success">Continue Shopping</a>
                        </div>
                    @endif
                </div>
                <div class="col-lg-6">
                    <div class="">
                        <div class="col-lg-12">
                            <div class="shoping__checkout">
                                <h5>Cart Total</h5>
                                <ul>
                                    <li>Subtotal <span>Rs. <span id="subtotal"></span></span></li>
                                    @if (session()->get('cart'))
                                        
                                    <li>Delivary Charge <span id="free">Rs. <span id="delicaryCharge">120</span></span></li>
                                    @endif
                                    <li>Total <span >Rs.<span id="netTotal"></span></span></li>
                                </ul>   
                                <a href="{{ route('checkout') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="shoping__cart__btns">
                                <a href="{{ route('products') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="shoping__continue">
                                <div class="shoping__discount">
                                    <h5>Discount Codes</h5>
                                    <form action="#" class="d-flex">
                                        <input type="text" placeholder="Enter your coupon code">
                                        <button type="submit" class="site-btn">APPLY COUPON</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection
