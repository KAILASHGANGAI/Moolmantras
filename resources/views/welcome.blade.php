@extends('layouts.app')

@section('content')
    {{-- departments and categories with banner --}}
    @include('parts.menu')
    {{-- categorirs- --}}
    @include('parts.categories')
    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".oranges">Oranges</li>
                            <li data-filter=".fresh-meat">Fresh Meat</li>
                            <li data-filter=".vegetables">Vegetables</li>
                            <li data-filter=".fastfood">Fastfood</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                
                <?php
                $products = collect([
                    (object) ['id' => 1, 'img' => 'assets/images/featured/feature-6.jpg', 'title' => 'Product 1', 'price' => '$100'],
                    (object) ['id' => 1, 'img' => 'assets/images/featured/feature-7.jpg', 'title' => 'Product 2', 'price' => '$200'],
                    (object) ['id' => 1, 'img' => 'assets/images/featured/feature-8.jpg', 'title' => 'Product 3', 'price' => '$300'],
                    // Add more products as needed
                ]);
                ?>
                @foreach ($products->collect() as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fastfood">
                    <x-ProductCard :id="$item->id" :img="$item->img" :title="$item->title"
                        :price="$item->price" />
            
                </div>
                @endforeach
            </div>
    </section>
    <!-- Featured Section End -->

    @include('parts.two-banner')
    @include('parts.reommended-products')
    @include('parts.blogs')
@endsection
