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
                @foreach ($featuredProducts as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fastfood">
                    <x-ProductCard :id="$item->sku" :img="$item->image" :title="$item->product_name"
                        :price="$item->selling_price" />
            
                </div>
                @endforeach
                
            </div>
    </section>
    <!-- Featured Section End -->

    @include('parts.two-banner')
    @include('parts.reommended-products')
    @include('parts.blogs')
@endsection
