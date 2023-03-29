<?php

namespace Progerio\Design\Strategy;

class FoodTaxStrategy implements TaxCalculatorStrategy
{
    private const TAX_RATE = 30.0;
    public function calculate(Product $product): float
    {
        return $product->getPrice() * (self::TAX_RATE / 100);
    }
}