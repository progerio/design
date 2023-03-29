<?php

namespace Strategy;

use PHPUnit\Framework\TestCase;
use Progerio\Design\Strategy\Context;
use Progerio\Design\Strategy\ElectronicTaxStrategy;
use Progerio\Design\Strategy\FoodTaxStrategy;
use Progerio\Design\Strategy\Product;
use Progerio\Design\Strategy\TaxCalculatorStrategy;
use Progerio\Design\Strategy\TaxFreeStrategy;
use RuntimeException;

class ContextStrategyTestCase extends TestCase
{

    public function getStrategy(Product $product): TaxCalculatorStrategy
    {
        switch ($product->getCategory()) {
            case 'eletronic':
                $strategy = new ElectronicTaxStrategy();
                break;
            case 'food':
                $strategy = new FoodTaxStrategy();
                break;
            case 'books':
                $strategy = new TaxFreeStrategy();
                break;
            default:
                throw new RuntimeException('not found for this category');
        }
        return $strategy;
    }

    public function testTaxProductCategoryFood(): void
    {
        $product = new Product();
        $product->setName('Product test eletronic')
            ->setCategory('food')
            ->setPrice(100);

        $strategy = $this->getStrategy($product);

        $context = new Context($strategy);
        $context->calculateProduct($product);
        $this->assertEquals(30, $product->getTaxes());
    }

    public function testTaxProductCategoryEletronic(): void
    {
        $product = new Product();
        $product->setName('Product test eletronic')
            ->setCategory('eletronic')
            ->setPrice(100);

        $strategy = $this->getStrategy($product);

        $context = new Context($strategy);
        $context->calculateProduct($product);
        $this->assertEquals(40, $product->getTaxes());
    }

    public function testTaxProductCategoryBooks(): void
    {
        $product = new Product();
        $product->setName('Product test eletronic')
            ->setCategory('books')
            ->setPrice(100);

        $strategy = $this->getStrategy($product);

        $context = new Context($strategy);
        $context->calculateProduct($product);
        $this->assertEquals(0, $product->getTaxes());
    }
}