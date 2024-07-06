 <!-- Categories Section Begin -->
 <section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php 
                         $collection = collect([
                                (object)['id'=>1, 'img' => 'assets/images/categories/cat-1.jpg', 'title' => 'Product 1'],
                                (object)['id'=>1, 'img' => 'assets/images/categories/cat-1.jpg', 'title' => 'Product 2' ],
                                (object)['id'=>1, 'img' => 'assets/images/categories/cat-1.jpg', 'title' => 'Product 3'],
                                // Add more products as needed
                            ]);
                    ?>
                @foreach ($collection as $item)
                <div class="col-lg-3">
                    <x-category-card :id="$item->id" :title="$item->title" :img="$item->img"/>
                </div>
                @endforeach
                
               
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->