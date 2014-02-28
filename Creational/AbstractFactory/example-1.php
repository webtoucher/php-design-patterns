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
interface FirstProduct
{

    /**
     * Returns product name
     *
     * @return string
     */
    public function getName();
}

/**
 * Some another product
 */
interface SecondProduct
{

    /**
     * Returns product name
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
     * Returns the first product
     *
     * @return FirstProduct
     */
    abstract public function getFirstProduct();

    /**
     * Returns second product
     *
     * @return SecondProduct
     */
    abstract public function getSecondProduct();
}

/*
 * =====================================
 *             FIRST FAMILY
 * =====================================
 */

class FirstFactory extends AbstractFactory
{

    /**
     * Returns the first product
     *
     * @return FirstProduct
     */
    public function getFirstProduct()
    {
        return new FirstFactoryFirstProduct();
    }

    /**
     * Returns second product
     *
     * @return SecondProduct
     */
    public function getSecondProduct()
    {
        return new FirstFactorySecondProduct();
    }
}

/**
 * The first product from the first factory
 */
class FirstFactoryFirstProduct implements FirstProduct
{

    /**
     * Returns product name
     *
     * @return string
     */
    public function getName()
    {
        return 'The first product from the first factory';
    }
}

/**
 * Second product from the first factory
 */
class FirstFactorySecondProduct implements SecondProduct
{

    /**
     * Returns product name
     *
     * @return string
     */
    public function getName()
    {
        return 'Second product from the first factory';
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
     * Returns the first product
     *
     * @return FirstProduct
     */
    public function getFirstProduct()
    {
        return new SecondFactoryFirstProduct();
    }

    /**
     * Returns second product
     *
     * @return SecondProduct
     */
    public function getSecondProduct()
    {
        return new SecondFactorySecondProduct();
    }
}

/**
 * The first product from second factory
 */
class SecondFactoryFirstProduct implements FirstProduct
{

    /**
     * Returns product name
     *
     * @return string
     */
    public function getName()
    {
        return 'The first product from second factory';
    }
}

/**
 * Second product from second factory
 */
class SecondFactorySecondProduct implements SecondProduct
{

    /**
     * Returns product name
     *
     * @return string
     */
    public function getName()
    {
        return 'Second product from second factory';
    }
}

/*
 * =====================================
 *       USING OF ABSTRACT FACTORY
 * =====================================
 */

$firstProduct = AbstractFactory::getFactory()->getFirstProduct();
Config::$factory = 2;
$secondProduct = AbstractFactory::getFactory()->getSecondProduct();

print_r($firstProduct->getName());
// The first product from the first factory
print_r($secondProduct->getName());
// Second product from second factory
