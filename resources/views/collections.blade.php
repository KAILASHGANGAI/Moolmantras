@extends('layouts.app')
@section('content')
    @include('parts.nobanner-menu')
    <section class="categories">
        <div class="container">
            <div class="row">
           
                    
                    @foreach ($collections as $item)
                    <div class="col-lg-3 p-2">
                        <x-category-card :id="$item->slug" :title="$item->category_name" :img="$item->image"/>
                    </div>
                    @endforeach
                    
                   
                </div>
    
        </div>
    </section>
@endsection
