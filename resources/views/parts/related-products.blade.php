    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedProduct as $item)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <x-ProductCard 
                    :id="$item->sku" 
                    :img="$item->image" 
                    :title="$item->product_name"
                    :sprice="$item->selling_price" 
                    :cprice="$item->compare_price" 
                    :itemSpecific="'lorem'" 
                    :category="$item->category->category_name" />
                </div>
                @endforeach
              
               
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->