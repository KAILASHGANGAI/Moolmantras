    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($latestProducts->chunk(4) as $chunk)
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($chunk as $item)
                                        <x-product :id="$item->sku" :img="$item->image" :title="$item->product_name"
                                            :price="$item->selling_price" />
                                    @endforeach
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($ratedProducts->chunk(4) as $chunk)
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($chunk as $item)
                                        <x-product :id="$item->sku" :img="$item->image" :title="$item->product_name"
                                            :price="$item->selling_price" />
                                    @endforeach
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($reviewedProducts->chunk(4) as $chunk)
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($chunk as $item)
                                        <x-product :id="$item->sku" :img="$item->image" :title="$item->product_name"
                                            :price="$item->selling_price" />
                                    @endforeach
                                </div>
                            @endforeach

                        </div>

                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->
