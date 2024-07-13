@extends('layouts.app')

@section('title' , 'Petzone')

@inject('basketAtViews', 'App\Support\Basket\BasketAtViews')

@section('content')

<!-- Offer books start -->
<section id="special-offer" class="bookshelf">
    <div class="section-header align-center">
        <div class="title">
            <span>Paws, Purrs, and Beyond: Where Every Pet's Tale Begins!</span>
        </div>
        <h2 class="section-title">Discounted Pet Books</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="inner-content">    
                <div class="product-list" data-aos="fade-up">
                    <div class="grid product-grid" id="product-grid">
                        <!-- Products will be loaded here by jQuery -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Offer books end -->

<!-- quote of the day start -->
<section id="quotation" class="align-center">
    <div class="inner-content" id="margin-t-200">
        <h2 class="section-title divider">Inspirational Insight</h2>
        <blockquote data-aos="fade-up">
            <q>Animals are such agreeable friends—they ask no questions; they pass no criticisms.</q>
            <div class="author-name">George Eliot</div>            
        </blockquote>
    </div>        
</section>
<!-- quote of the day end -->

<!-- Product Details Modal -->
<div id="productModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="product-details">
            <!-- Product details will be loaded here by jQuery -->
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Fetch and display products
    $.getJSON("{{ route('api.products.index') }}", function(data) {
        var productGrid = $('#product-grid');
        $.each(data, function(index, product) {
            var productHtml = `
                <figure class="product-style">
                    <img src="images/products/${product.demo_url}" alt="Books" class="product-item">
                    <a href="{{ route('shop.basket.add', '') }}/${product.id}"><button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button></a>
                    <figcaption>    
                        <h3><a href="#" class="product-title" data-id="${product.id}">${product.title}</a></h3>
                        <p>${product.author}</p>
                        <div class="item-price">
                            <span class="prev-price">$${product.price}</span>
                        </div>
                    </figcaption>
                </figure>`;
            productGrid.append(productHtml);
        });
    });

    // Show product details in modal
    $(document).on('click', '.product-title', function(e) {
        e.preventDefault();
        var productId = $(this).data('id');
        $.getJSON("{{ url('api/products') }}/" + productId, function(product) {
            var productDetails = `
                <h1>${product.title}</h1>
                <h3>${product.author}</h3>
                <h4>${product.category.title}</h4>
                <h2>$${product.price}</h2>
                <p>${product.description}</p>
                <img src="images/products/${product.demo_url}" alt="Books" class="product-item">`;
            $('#product-details').html(productDetails);
            $('#productModal').show();
        });
    });

    // Close modal
    $('.close').click(function() {
        $('#productModal').hide();
    });
});
</script>
@endsection