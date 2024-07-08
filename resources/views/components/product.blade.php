<div>
    <a href="{{ route('showProduct',$id) }}" class="latest-product__item">
        <div class="latest-product__item__pic">
            <x-productImage :img="$img" :title="$title" />
        </div>
        <div class="latest-product__item__text">
            <h6>{{ Str::ucfirst($title) }}</h6>
            <span>{{ $price }}</span>
        </div>
    </a>
</div>