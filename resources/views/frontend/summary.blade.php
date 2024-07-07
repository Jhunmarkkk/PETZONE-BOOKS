SUMMARY NG ORDER TOTAL - CALCULATED


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
        <a class="primary-btn" id="btn-summary" href="{{ route('shop.checkout.index') }}">CHECKOUT</a>
    @endif
</div>
<!-- Summary end -->

