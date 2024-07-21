{{-- 
<div class="featured__item">
    <div class="featured__item__pic set-bg" data-setbg="{{asset($img)}}">
        <ul class="featured__item__pic__hover">
            <li><a href="{{ route('showProduct',$id) }}"><i class="fa fa-heart"></i></a></li>
            <li><a href="{{ route('showProduct',$id) }}"><i class="fa fa-retweet"></i></a></li>
            <li><a href="{{ route('showProduct',$id) }}"><i class="fa fa-shopping-cart"></i></a></li>
        </ul>
    </div>
    <div class="featured__item__text">
        <h6 class="text-bolder"><a href="{{ route('showProduct',$id) }}">{{ $title }}</a></h6>
        @if($itemSpecific)
        <span class="text-secondary">{{ $itemSpecific }}</span>
        @endif
        <h5>Rs. {{ $price }} /-</h5>
    </div>
</div> --}}


<div class="product-card">
    {{-- <div class="badge">New Product</div> --}}
    <a href="{{ route('showProduct',$id) }}" class="product-thumb">
        <img src="{{ $img }}">
    </a>
    <div class="product-details">
        <span class="product-category">{{ $category }}</span>
        <h5><a class="p-title" href="{{ route('showProduct', $id) }}">{{ $title }}</a></h5>
        <p>{{ $itemSpecific }}</p>
        <div class="product-bottom-details d-flex justify-content-between ">
            <div class="product-price"><small>Rs. {{ $cprice }}</small>Rs. {{ $sprice }}</div>
            <div class="product-links">
                <ul class="featured__item__card">
                    <li class="text-style-none"><a  href="{{ route('cart.add',$id) }}"><i class="fa fa-heart"></i></a></li>
                    <li class="text-style-none"><a  href="{{ route('cart.add',$id) }}"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
