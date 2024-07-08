<div class="blog__item">
    <div class="blog__item__pic">
        <img src="{{ $img }}" alt="">
    </div>
    <div class="blog__item__text">
        <ul>
            <li><i class="fa fa-calendar-o"></i>{{ $publishDate }}</li>
            <li><i class="fa fa-comment-o"></i> {{ $viewCount }}</li>
        </ul>
        <h5><a href="{{ route('blog', $slug) }}">{{ $title }}</a></h5>
        <p>{{ $description }}</p>
    </div>
</div>