<div class="product__discount">
    <div class="section-title product__discount__title">
        <h2>Sale Off</h2>
    </div>
    <div class="row">
        <div class="product__discount__slider owl-carousel">
            @foreach ($offerProducts as $item)
                <div class="col-lg-4">
                    <x-offer-product-card :id="$item->sku" :img="$item->image" :title="$item->product_name"
                        :sprice="$item->selling_price" :cprice="$item->selling_price" :category="$item->selling_price" :discount="$item->selling_price" />
                </div>
            @endforeach

        </div>
    </div>
</div>