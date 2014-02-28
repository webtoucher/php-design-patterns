<?php
/**
 * Some product
 */
class Product
{

    /**
     * @var string
     */
    private $name;


    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }
}

/**
 * Director class
 */
class Director
{

    /**
     * @var Builder
     */
    private $builder;


    /**
     * @param Builder $builder
     */
    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
        $this->builder->buildProduct();
    }

    /**
     * Returns the built product
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->builder->getProduct();
    }
}

/**
 * Builder class
 */
abstract class Builder
{

    /**
     * @var Product
     */
    protected $product;


    /**
     * Returns the built product
     *
     * @return Product
     */
    final public function getProduct()
    {
        return $this->product;
    }

    /**
     * Creates the product
     *
     * @return void
     */
    public function buildProduct()
    {
        $this->product = new Product();
    }
}

/**
 * The first builder
 */
class FirstBuilder extends Builder
{

    /**
     * Creates the product
     *
     * @return void
     */
    public function buildProduct()
    {
        parent::buildProduct();
        $this->product->setName('The product of the first builder');
    }
}

/**
 * Second builder
 */
class SecondBuilder extends Builder
{

    /**
     * Creates the product
     *
     * @return void
     */
    public function buildProduct()
    {
        parent::buildProduct();
        $this->product->setName('The product of second builder');
    }
}

/*
 * =====================================
 *            USING OF BUILDER
 * =====================================
 */

$firstDirector = new Director(new FirstBuilder());
$secondDirector = new Director(new SecondBuilder());

print_r($firstDirector->getProduct());
// The product of the first builder
print_r($secondDirector->getProduct());
// The product of second builder
