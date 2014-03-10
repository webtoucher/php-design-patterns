<?php
/**
 * Some product
 */
interface Product
{
}

/**
 * Prototype factory
 */
class Factory
{

    /**
     * @var Product
     */
    private $product;


    /**
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Returns new instance of the product by cloning
     *
     * @return Product
     */
    public function getProduct()
    {
        return clone $this->product;
    }
}

/**
 * The product
 */
class SomeProduct implements Product
{
    public $name;
}

/*
 * =====================================
 *          USING OF PROTOTYPE
 * =====================================
 */

$prototypeFactory = new Factory(new SomeProduct());

$firstProduct = $prototypeFactory->getProduct();
$firstProduct->name = 'The first product';

$secondProduct = $prototypeFactory->getProduct();
$secondProduct->name = 'Second product';

print_r($firstProduct->name);
// The first product
print_r($secondProduct->name);
// Second product
