<?php

namespace Progerio\Design\Strategy;
interface TaxCalculatorStrategy
{
    public function calculate(Product $product): float;
}