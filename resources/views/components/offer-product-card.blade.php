<div class="product__discount__item">
    <div class="product__discount__item__pic set-bg"
        data-setbg="{{ $img }}">
        <div class="product__discount__percent">{{ $discount }}</div>
        <ul class="product__item__pic__hover">
            <li><a href="{{ route('showProduct', $id) }}"><i class="fa fa-heart"></i></a></li>
            <li><a href="{{ route('showProduct', $id) }}"><i class="fa fa-retweet"></i></a></li>
            <li><a href="{{ route('showProduct', $id) }}"><i class="fa fa-shopping-cart"></i></a></li>
        </ul>
    </div>
    <div class="product__discount__item__text">
        <span>{{ Str::ucfirst($category) }}</span>
        <h5><a href="#">{{ Str::ucfirst($title) }}</a></h5>
        <div class="product__item__price">{{ $sprice }}<span>{{ $cprice }}</span></div>
    </div>
</div>