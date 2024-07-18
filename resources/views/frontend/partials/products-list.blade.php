@foreach ($products as $product)
    <figure class="product-style">
        <img src="images/products/{{ $product->demo_url }}" alt="Books" class="product-item">
        <a href="{{ route('shop.basket.add', $product->id) }}"><button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button></a>
        <figcaption>
            <h3><a href="{{ route('shop.products.show', $product->id) }}">{{ $product->title }}</a></h3>
            <p>{{ $product->author }}</p>
            <div class="item-price">${{ $product->price }}</div>
            @if($basketAtViews->hasQuantity($product->id))
                <div>
                    <a href="{{ route('shop.basket.add', $product->id) }}" class="increase">+</a>
                    <span class="quantity">{{ $basketAtViews->getQuantity($product->id) }}</span>
                    <a href="{{ route('shop.basket.remove', $product->id) }}" class="decrease">-</a>
                </div>
            @endif
        </figcaption>
    </figure>
@endforeach