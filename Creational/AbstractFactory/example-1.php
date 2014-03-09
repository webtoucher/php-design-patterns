<?php
/**
 * Some config
 */
class Config
{
    public static $factory = 1;
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
 * Simple abstract factory
 */
abstract class AbstractFactory
{

    /**
     * Returns factory
     *
     * @return AbstractFactory - object that extends AbstractFactory
     * @throws Exception
     */
    public static function getFactory()
    {
        switch (Config::$factory) {
            case 1:
                return new FirstFactory();
            case 2:
                return new SecondFactory();
        }
        throw new Exception('Bad config');
    }

    /**
     * Returns the product
     *
     * @return Product
     */
    abstract public function getProduct();
}

/*
 * =====================================
 *             FIRST FAMILY
 * =====================================
 */

class FirstFactory extends AbstractFactory
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
 * The product from the first factory
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
        return 'The product from the first factory';
    }
}

/*
 * =====================================
 *             SECOND FAMILY
 * =====================================
 */

class SecondFactory extends AbstractFactory
{

    /**
     * Returns the product
     *
     * @return Product
     */
    public function getProduct()
    {
        return new SecondProduct();
    }
}

/**
 * The product from second factory
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
        return 'The product from second factory';
    }
}

/*
 * =====================================
 *       USING OF ABSTRACT FACTORY
 * =====================================
 */

$firstProduct = AbstractFactory::getFactory()->getProduct();
Config::$factory = 2;
$secondProduct = AbstractFactory::getFactory()->getProduct();

print_r($firstProduct->getName());
// The first product from the first factory
print_r($secondProduct->getName());
// Second product from second factory
