<?php

namespace Progerio\Design\Strategy;

class ElectronicTaxStrategy implements TaxCalculatorStrategy
{
    private const TAX_RATE = 40.0;
    public function calculate(Product $product): float
    {
        return $product->getPrice() * (self::TAX_RATE / 100);
    }
}