    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <?php
                        $LatestProducts = collect([
                            (object) ['id' => 1, 'img' => 'assets/images/latest-product/lp-1.jpg', 'title' => 'Product 1', 'price' => '$100'], 
                            (object) ['id' => 2, 'img' => 'assets/images/latest-product/lp-1.jpg', 'title' => 'Product 1', 'price' => '$100'], (object) ['id' => 1, 'img' => 'assets/images/latest-product/lp-1.jpg', 'title' => 'Product 1', 'price' => '$100'], 
                            (object) ['id' => 3, 'img' => 'assets/images/latest-product/lp-1.jpg', 'title' => 'Product 1', 'price' => '$100']]);
                        ?>

                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($LatestProducts->collect() as $item)
                                    <x-product :id="$item->id" :img="$item->img" :title="$item->title"
                                        :price="$item->price" />
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($LatestProducts->collect() as $item)
                                    <x-product :id="$item->id" :img="$item->img" :title="$item->title"
                                        :price="$item->price" />
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($LatestProducts->collect() as $item)
                                    <x-product :id="$item->id" :img="$item->img" :title="$item->title"
                                        :price="$item->price" />
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->
