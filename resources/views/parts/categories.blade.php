 <!-- Categories Section Begin -->
 <section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                
                @foreach ($categories as $item)
                <div class="col-lg-3">
                    <x-category-card :id="$item->slug" :title="$item->category_name" :img="$item->image"/>
                </div>
                @endforeach
                
               
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->