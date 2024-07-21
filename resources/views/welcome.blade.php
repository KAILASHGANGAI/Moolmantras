@extends('layouts.app')

@section('content')
    {{-- departments and categories with banner --}}
    @include('parts.menu')
    {{-- categorirs- --}}
    @include('parts.categories')
    <!-- Featured Section Begin -->
    <section class="container spad pb-0">
        @include('parts.offerProducts')
    </section>
    <section class="featured p-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                </div>
            </div>
           
            <div class="row featured__filter">
                @foreach ($featuredProducts as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 p-2">
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
    </section>
    <!-- Featured Section End -->

    @include('parts.two-banner')
    @include('parts.reommended-products')
    @include('parts.blogs')
@endsection
