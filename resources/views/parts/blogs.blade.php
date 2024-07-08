  <!-- Blog Section Begin -->
  <section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>From The Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
         

            @php
                $blogs= [
                    (object)['slug'=>'slud', 
                    'title'=>'blog title', 'description'=>'Hi this is description', 
                    'publishDate'=> '2024-4-05',
                    'viewCount'=>2,
                    'img'=>'assets/images/blog/blog-2.jpg']
        ];
            @endphp
            @foreach ($blogs as $blog)
            <div class="col-lg-4 col-md-4 col-sm-6">
                <x-blog-card
                    :slug="$blog->slug"
                    :title="$blog->title"
                    :description="$blog->description"
                    :viewCount="$blog->viewCount"
                    :publishDate="$blog->publishDate"
                    :img="$blog->img"
                />
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- Blog Section End -->