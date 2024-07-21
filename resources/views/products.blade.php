@extends('layouts.app')
@section('content')
    @include('parts.nobanner-menu')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/images/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>All Products</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Products</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Categories</h4>
                            <ul>
                                @foreach ($categories as $item)
                                    <li><a
                                            href="{{ route('collection', $item->slug) }}">{{ Str::ucfirst($item->category_name) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="sidebar__item sidebar__item__color--option">
                            <h4>Colors</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Gray
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Popular Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div> --}}

                    </div>
                </div>
                <div class="col-lg-9 col-md-7">

                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-6 col-md-5 d-flex">
                                <div class="filter__sort">


                                    <span>Sort By</span>
                                    <select id="sortSelect" onchange="handleChange(this)">
                                        <option value="featured">Featured</option>
                                        <option {{ $pageCondition['sort'] == 'alphabet_asc' ? 'selected' : '' }}
                                            value="alphabet_asc">Name: A-Z</option>
                                        <option {{ $pageCondition['sort'] == 'alphabet_desc' ? 'selected' : '' }}
                                            value="alphabet_desc">Name: Z-A</option>
                                        <option {{ $pageCondition['sort'] == 'price_asc' ? 'selected' : '' }}
                                            value="price_asc">Price: Low to High</option>
                                        <option {{ $pageCondition['sort'] == 'price_desc' ? 'selected' : '' }}
                                            value="price_desc">Price: High to Low</option>
                                        <option {{ $pageCondition['sort'] == 'popularity' ? 'selected' : '' }}
                                            value="popularity">Popularity</option>
                                        <option {{ $pageCondition['sort'] == 'newest' ? 'selected' : '' }} value="newest">
                                            Newest Arrivals</option>
                                        <option {{ $pageCondition['sort'] == 'oldest' ? 'selected' : '' }} value="oldest">
                                            Older Arrivals</option>
                                    </select>
                                </div>
                                <div class="filter__sort">


                                    <select id="paginateSelect" onchange="paginateSelect(this)">

                                        <option {{ $pageCondition['pagination'] == 12 ? 'selected' : '' }} value="12">12
                                        </option>
                                        <option {{ $pageCondition['pagination'] == 20 ? 'selected' : '' }} value="20">20
                                        </option>
                                        <option {{ $pageCondition['pagination'] == 30 ? 'selected' : '' }} value="30">30
                                        </option>
                                        <option {{ $pageCondition['pagination'] == 50 ? 'selected' : '' }} value="50">50
                                        </option>
                                        >
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{ $totalCountProducts }}</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row featured__filter">
                        @if ($featuredProducts)
                            @foreach ($featuredProducts as $item)
                                <div class="col-lg-4 col-md-4 col-sm-6 p-2">
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
                        @endif

                    </div>

                    {{ $featuredProducts->appends($pageCondition)->links() }}

                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection
@section('jsScript')
    <script>
        function handleChange(selectElement) {
            const selectedValue = selectElement.value;
            const currentUrl = window.location.href; // Get current URL

            // Check if current URL already has a query string
            if (currentUrl.includes('?')) {
                // URL already has a query string
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('sort')) {
                    // Change the value of existing 'sort' parameter
                    urlParams.set('sort', selectedValue);
                } else {
                    // Add 'sort' parameter to the existing query string
                    urlParams.append('sort', selectedValue);
                }
                newUrl = `${currentUrl.split('?')[0]}?${urlParams.toString()}`;
            } else {
                // URL does not have a query string
                newUrl = `${currentUrl}?sort=${selectedValue}`;
            }

            window.location.href = newUrl; // Redirect to the new URL with sorting parameter
        }

        function paginateSelect(selectElement) {
            const selectedValue = selectElement.value;
            const currentUrl = window.location.href; // Get current URL

            // Check if current URL already has a query string
            if (currentUrl.includes('?')) {
                // URL already has a query string
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('pagination')) {
                    // Change the value of existing 'pagination' parameter
                    urlParams.set('pagination', selectedValue);
                } else {
                    // Add 'pagination' parameter to the existing query string
                    urlParams.append('pagination', selectedValue);
                }
                newUrl = `${currentUrl.split('?')[0]}?${urlParams.toString()}`;
            } else {
                // URL does not have a query string
                newUrl = `${currentUrl}?pagination=${selectedValue}`;
            }

            window.location.href = newUrl; // Redirect to the new URL with pagination parameter
        }
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var nextPageUrl = '{{ $featuredProducts->nextPageUrl() }}';

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                if (nextPageUrl) {
                    $.ajax({
                        url: nextPageUrl,
                        method: 'GET',
                        success: function(response) {
                            // Append new products to the list
                            $('.products-list').append(response);

                            // Update nextPageUrl for the next request
                            nextPageUrl = $(response).filter('.pagination').find('.next a').attr('href');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error loading more products:', error);
                        }
                    });
                }
            }
        });
    });
</script>
@endsection
