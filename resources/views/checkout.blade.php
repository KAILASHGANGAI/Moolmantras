@extends('layouts.app')
@section('content')
    @include('parts.nobanner-menu')
    <!-- Checkout Section Begin -->
    <section class="checkout pt-4">
        <div class="container">

            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Full Name<span>*</span></p>
                                        <input type="text" name="name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Province /State<span>*</span></p>
                                        <input type="text" name="provinance">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="checkout__input">
                                        <p>District<span>*</span></p>
                                        <input type="text" name="district">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="checkout__input">
                                        <p>Gaupalika<span>*</span></p>
                                        <input type="text" name="city">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="checkout__input">
                                        <p>Ward No.<span>*</span></p>
                                        <input type="text" name="wardno">
                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address1" placeholder="Street Address"
                                    class="checkout__input__add">
                                <input type="text" name="address2" placeholder="Apartment, suite, unite ect (optinal)">
                            </div>



                            <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Create an account?
                                    <input type="checkbox" id="acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <p>Create an account by entering the information below. If you are a returning customer
                                please login at the top of the page</p>
                            <div class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Ship to a different address?
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            @if (session()->get('cart'))
                                <div class="checkout__order">
                                    <h4>Your Order</h4>
                                    <div class="checkout__order__products">Products <span>Total</span></div>
                                    <ul>
                                        @foreach (session()->get('cart') as $cart)
                                            <li>{{ $cart['name'] }} <span>Rs. <span
                                                        class="mytotal">{{ $cart['quantity'] * $cart['price'] }}</span></span>
                                            </li>
                                        @endforeach

                                    </ul>
                                    <div class="checkout__order__subtotal">Subtotal : <span>Rs. <span
                                                class ="subtotal"></span></span></div>
                                    <div class="checkout__order__total">Delivary Charge: <span class="free">Rs. <span
                                                class="delivaryCharge">120</span></span></div>
                                    <div class="checkout__order__total">Total <span>Rs. <span
                                                class="nettotal"></span></span></div>

                                    <div class="checkout__input__checkbox">
                                        <label for="payment">
                                            Case On     Delivary
                                            <input type="checkbox" name="homedelivary" id="payment">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox">
                                        <a href="{{ route('esewa.checkout', 'product') }}" class=""><img class="" style="width: 50px;"  src="{{ asset('assets/images/esewa.png') }}" alt=""></a>
                                        {{-- <a href="{{ route('khalti.checkout', 'product') }}" class=""><img class="" style="width: 50px;"  src="{{ asset('assets/images/khalti.jpg') }}" alt=""></a> --}}
                                        <a href="{{ route('fonepay.checkout', 'product') }}" class=""><img class="" style="width: 90px;"  src="{{ asset('assets/images/fonepay.png') }}" alt=""></a>
    
                                    </div>
                                
                                    <button type="submit" class="site-btn">PLACE ORDER</button>
                                </div>
                            @else
                                <a class="btn btn-success" href="{{ route('products') }}">Continue Shopping..</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

 
        
 
        
@endsection
