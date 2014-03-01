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
     * @var Product
     */
    protected $firstProduct;

    /**
     * @var Product
     */
    protected $secondProduct;


    /**
     * Returns the product
     *
     * @return Product
     */
    public function getFirstProduct()
    {

        if (!$this->firstProduct) {
            $this->firstProduct = new FirstProduct();
        }
        return $this->firstProduct;
    }

    /**
     * Returns the product
     *
     * @return Product
     */
    public function getSecondProduct()
    {

        if (!$this->secondProduct) {
            $this->secondProduct = new FirstProduct();
        }
        return $this->secondProduct;
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
 *      USING OF LAZY INITIALIZATION
 * =====================================
 */

$factory = new Factory();

print_r($factory->getFirstProduct()->getName());
// The first product
print_r($factory->getSecondProduct()->getName());
// Second product
print_r($factory->getFirstProduct()->getName());
// The first product
