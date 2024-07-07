<?php
namespace App\Services\Shop\Traits;

use App\Exceptions\InvalidCost;
use App\Support\Cost\Contract\CostInterface;

trait HasCheckout {
    /**
     * Total cost validation
     *
     * @param CostInterface $cost
     * @return void
     */
    public function validationCost(CostInterface $cost) {
        if ($cost->getTotalCost() <= 1) {
            throw new InvalidCost("Invalid Cost!");
        }
    }    
}