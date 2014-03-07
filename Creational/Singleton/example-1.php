<?php
/**
 * Simple singleton class
 *
 * @package Patterns
 */
class Product
{

    private static $instance;

    public $a;


    /**
     * Returns singleton
     *
     * @return self
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * The constructor is disabled
     */
    protected function __construct()
    {
    }

    /**
     * Cloning is disabled
     */
    protected function __clone()
    {
    }

    /**
     * Serialization is disabled
     */
    protected function __sleep()
    {
    }

    /**
     * Unserialization is disabled
     */
    protected function __wakeup()
    {
    }
}

/*
 * =====================================
 *           USING OF SINGLETON
 * =====================================
 */

$firstProduct = Product::getInstance();
$secondProduct = Product::getInstance();

$firstProduct->a = 1;
$secondProduct->a = 2;

print_r($firstProduct->a);
// 2
print_r($secondProduct->a);
// 2
