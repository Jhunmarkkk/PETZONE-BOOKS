HOME PAGE LANG TO - OKI NA YAN

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
					<div class="grid product-grid">			
						@foreach ($discountedBooks as $book)
							<figure class="product-style">
								<img src="images/products/{{ $book->demo_url }}" alt="Books" class="product-item">
								<a href="{{ route('shop.basket.add' , $book->id) }}"><button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button></a>
								<figcaption>	
									<h3><a href="{{ route('shop.products.show' , $book->id ) }}">{{ $book->title }}</a></h3>
									<p>{{ $book->author }}</p>
									<div class="item-price">
									<span class="prev-price">${{number_format($basketAtViews->beforeDiscount($book->id)) }}</span>${{ $book->price }}</div>
									@if($basketAtViews->hasQuantity($book->id))
										<div>
											<a href="{{ route('shop.basket.add' , $book->id)}}" class="increase">+</a>
											<span class="quantity">{{ $basketAtViews->getQuantity($book->id) }}</span>
											<a href="{{ route('shop.basket.remove' , $book->id )}}" class="decrease">-</a>
										</div>	
									@endif 	
								</figcaption>
							</figure>			
						@endforeach	
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

@endsection