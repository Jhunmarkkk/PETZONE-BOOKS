DISPLAYING NG MGA BOOKS

@extends('layouts.app')

@section('title', 'Shop')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/algolia.css') }} ">

@inject('basketAtViews', 'App\Support\Basket\BasketAtViews')

@section('content')
<!-- Shop page start -->
<section class="padding-large">
    <div class="container">

        <div class="searchbar-container">
            {{-- algolia search --}}
            <div class="aa-input-container" id="aa-input-container">
                <form action="{{ route('shop.products.index') }}" method="GET">
                    <input type="search" id="aa-search-input" class="aa-input-search" name="search" class="search_input"
                        id="prepare-search" value="{{ app('request')->input('search') }}" placeholder="Search..."
                        autocomplete="on" />
                </form>
            </div>
        </div>

        <ul class="tabs">
            @foreach ($all as $categoryName => $products)
                <li data-tab-target="#{{$categoryName}}" class="{{($categoryName == 'All') ? 'active tab' : 'tab'}}">{{$categoryName}}</li>
            @endforeach
        </ul>
        <div class="container">
            @foreach ($all as $categoryName => $products)
                <div id="{{$categoryName}}" data-tab-content class="{{ ($categoryName == 'All') ? 'active' : ''}}">
                    <div class="row">
                        <div class="products-grid grid">
                            @foreach ($products as $product)
                                <figure class="product-style">
                                    <img src="images/products/{{ $product->demo_url }}" alt="Books" class="product-item">
                                    <a href="{{ route('shop.basket.add' , $product->id) }}"><button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button></a>
                                    <figcaption>
                                        <h3><a href="{{ route('shop.products.show' , $product->id ) }}">{{ $product->title }}</a></h3>
                                        <p>{{ $product->author }}</p>
                                        <div class="item-price">${{ $product->price }}</div>
                                        @if($basketAtViews->hasQuantity($product->id))
                                            <div>
                                                <a href="{{ route('shop.basket.add' , $product->id)}}" class="increase">+</a>
                                                <span class="quantity">{{ $basketAtViews->getQuantity($product->id) }}</span>
                                                <a href="{{ route('shop.basket.remove' , $product->id) }}" class="decrease">-</a>
                                            </div>    
                                        @endif 
                                    </figcaption>
                                </figure>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Shop page end -->

<!-- Placeholder for infinite scroll -->
<div id="infinite-scroll-placeholder">
    <div class="products-grid grid"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var shopProductsIndexRoute = "{{ route('api.products.index') }}";
</script>
<script src="{{ asset('js/shop.js') }}"></script>
<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{ asset('js/algolia-autocomplete.js') }}"></script>

@endsection