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
     * @param integer|string $id - product's ID
     * @return Product $product
     */
    public static function getProduct($id)
    {
        return isset(self::$products[$id]) ? self::$products[$id] : null;
    }

    /**
     * Removes product from the pool by ID
     *
     * @param integer|string $id - product's ID
     * @return void
     */
    public static function removeProduct($id)
    {
        if (isset(self::$products[$id])) {
            unset(self::$products[$id]);
        }
    }
}

class Product
{

    /**
     * @var integer|string
     */
    protected $id;


    public function __construct($id) {
        $this->id = $id;
    }

    /**
     * @return integer|string
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
