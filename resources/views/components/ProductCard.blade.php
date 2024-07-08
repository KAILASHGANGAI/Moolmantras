
<div class="featured__item">
    <div class="featured__item__pic set-bg" data-setbg="{{asset($img)}}">
        <ul class="featured__item__pic__hover">
            <li><a href="{{ route('showProduct',$id) }}"><i class="fa fa-heart"></i></a></li>
            <li><a href="{{ route('showProduct',$id) }}"><i class="fa fa-retweet"></i></a></li>
            <li><a href="{{ route('showProduct',$id) }}"><i class="fa fa-shopping-cart"></i></a></li>
        </ul>
    </div>
    <div class="featured__item__text">
        <h6><a href="{{ route('showProduct',$id) }}">{{ $title }}</a></h6>
        <h5>Rs. {{ $price }} /-</h5>
    </div>
</div>
