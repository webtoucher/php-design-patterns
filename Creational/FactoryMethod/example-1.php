<?php
/**
 * Some product
 */
interface Product
{

    /**
     * Returns product name
     *
     * @return string
     */
    public function getName();
}

class Factory
{

    /**
     * Returns the product
     *
     * @return Product
     */
    public function getFirstProduct()
    {
        return new FirstProduct();
    }

    /**
     * Returns the product
     *
     * @return Product
     */
    public function getSecondProduct()
    {
        return new SecondProduct();
    }
}

/**
 * The first product
 */
class FirstProduct implements Product
{

    /**
     * Returns product name
     *
     * @return string
     */
    public function getName()
    {
        return 'The first product';
    }
}

/**
 * Second product
 */
class SecondProduct implements Product
{

    /**
     * Returns product name
     *
     * @return string
     */
    public function getName()
    {
        return 'Second product';
    }
}

/*
 * =====================================
 *        USING OF FACTORY METHOD
 * =====================================
 */

$factory = new Factory();
$firstProduct = $factory->getFirstProduct();
$secondProduct = $factory->getSecondProduct();

print_r($firstProduct->getName());
// The first product
print_r($secondProduct->getName());
// Second product
