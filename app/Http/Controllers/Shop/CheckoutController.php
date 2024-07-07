<?php 

namespace App\Http\Controllers\Shop;

use App\Exceptions\InvalidCost;
use App\Http\Controllers\Controller;
use App\Services\Shop\Traits\HasCheckout;
use Illuminate\Http\Request;
use App\Support\Basket\BasketAtViews;
use App\Support\Cost\Contract\CostInterface; // Import the CostInterface

class CheckoutController extends Controller {
    use HasCheckout;

    protected $basketAtViews;
    protected $cost;

    public function __construct(BasketAtViews $basketAtViews, CostInterface $cost) {
        $this->basketAtViews = $basketAtViews;
        $this->cost = $cost;
    }

    /**
     * Show checkout form 
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function checkoutForm() {
        try {
            $this->validationCost($this->cost);
            $view = view('frontend.checkout');
            $this->clearCart(); // Clear the cart after rendering the view
            return $view;
        } catch (InvalidCost $event) {
            return redirect()->route('shop.basket.index');
        }
    }

    private function clearCart() {
        // Implement your cart clearing logic here
        $this->basketAtViews->clear(); // Assuming you have a clear method in BasketAtViews
    }
}