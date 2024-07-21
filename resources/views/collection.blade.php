@extends('layouts.app')
@section('content')
    @include('parts.nobanner-menu')
    <section class="featured spad">
        <div class="container">
            @if (count($products) > 0)
                <div class="row featured__filter">
                    @foreach ($products as $item)
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
            @else
               <div class="text-center">
                <h6 class=" text-center">NO Products Found</h6>
                <a class="btn btn-success mt-4" href="{{ route('collections') }}">All Collections</a>
               </div>
            @endif

<div class="text-center">
    {{ $products->links() }}
</div>
    </section>
@endsection
