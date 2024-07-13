@inject('cost', 'App\Support\Cost\Contract\CostInterface')
@inject('routes', 'App\Services\Setters\Routes')

<!-- Summary start -->
<div class="cart__total">
    <h6>Summary</h6>
    <ul style="padding-left: 0rem;">
        @foreach($cost->getSummary() as $key => $value)
            <li>{{ $key }} <span>${{ number_format($value) }}</span></li>
        @endforeach
        <li>Total <span>${{ number_format($cost->getTotalCost()) }}</span></li>
    </ul>
    @if($routes->view_SetRouteForSummaryBtn() === 'basket')
        <a class="primary-btn" id="btn-summary" href="#">CHECKOUT</a>
        <form id="checkout-form" style="display: none;">
            @csrf
            @foreach($basketAtViews->giveSelectedProducts() as $product)
                <input type="hidden" name="products[]" value="{{ $product['id'] }}">
                <input type="hidden" name="quantities[{{ $product['id'] }}]" value="{{ $product['quantity'] }}">
            @endforeach
        </form>
    @endif
</div>
<!-- Summary end -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#btn-summary').click(function(event) {
            event.preventDefault();

            var products = [];
            var quantities = {};
            $('#checkout-form input[name="products[]"]').each(function() {
                products.push($(this).val());
            });
            $('#checkout-form input[name^="quantities"]').each(function() {
                var productId = $(this).attr('name').match(/\d+/)[0];
                quantities[productId] = $(this).val();
            });

            $.ajax({
                url: '{{ route("api.checkout.process") }}',
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer {{ auth()->user()->createToken("API Token")->plainTextToken }}',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    products: products,
                    quantities: quantities
                },
                success: function(response) {
                    window.location.href = '{{ route("shop.checkout.index") }}?total_cost=' + response.total_cost;
                },
                error: function(xhr) {
                    alert('Error placing order: ' + xhr.responseText);
                }
            });
        });
    });
</script>


