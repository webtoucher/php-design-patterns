<?php
/**
 * Object pool
 *
 * @package Patterns
 */
class Factory
{

    /**
     * @var Product[]
     */
    protected static $products = array();


    /**
     * Adds product into the pool
     *
     * @param Product $product
     * @return void
     */
    public static function pushProduct(Product $product)
    {
        self::$products[$product->getId()] = $product;
    }

    /**
     * Returns product from the pool by ID
     *
     * @param $id - product's ID
     * @return Product $product
     */
    public static function getProduct($id)
    {
        if (isset(self::$products[$id])) {
            return self::$products[$id];
        }
    }

    /**
     * Removes product from the pool by ID
     *
     * @param $id - product's ID
     * @return void
     */
    final public static function removeProduct($id)
    {
        if (isset(self::$products[$id])) {
            unset(self::$products[$id]);
        }
    }
}

class Product
{

    /**
     * @var integer
     */
    protected $id;


    public function __construct($id) {
        $this->id = $id;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

/*
 * =====================================
 *         USING OF OBJECT POOL
 * =====================================
 */

Factory::pushProduct(new Product('first'));
Factory::pushProduct(new Product('second'));

print_r(Factory::getProduct('first')->getId());
// first
print_r(Factory::getProduct('second')->getId());
// second
