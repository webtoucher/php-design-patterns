<?php
/**
 * Some factory
 */
interface Factory
{

    /**
     * Returns product
     *
     * @return Product
     */
    public function getProduct();
}

/**
 * Some product
 */
interface Product
{

    /**
     * Returns product's name
     *
     * @return string
     */
    public function getName();
}

/**
 * First factory
 */
class FirstFactory implements Factory
{

    /**
     * Returns the product
     *
     * @return Product
     */
    public function getProduct()
    {
        return new FirstProduct();
    }
}

/**
 * Second factory
 */
class SecondFactory implements Factory
{

    /**
     * Returns the product
     *
     * @return Product
     */
    public function getProduct()
    {
        return new FirstProduct();
    }
}

/**
 * The first product
 */
class FirstProduct implements Product
{

    /**
     * Returns product's name
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
     * Returns product's name
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

$factory = new FirstFactory();
$firstProduct = $factory->getProduct();
$factory = new SecondFactory();
$secondProduct = $factory->getProduct();

print_r($firstProduct->getName());
// The first product
print_r($secondProduct->getName());
// Second product
