<?php
/**
 * General multiton abstract class
 *
 * @package Patterns
 */
abstract class FactoryAbstract
{

    /**
     * @var array
     */
    protected static $instances = array();


    /**
     * Returns singleton
     *
     * @return static
     */
    public static function getInstance()
    {
        $className = static::getClassName();
        if (!isset(self::$instances[$className])) {
            self::$instances[$className] = new $className();
        }
        return self::$instances[$className];
    }

    /**
     * Removes singleton
     *
     * @return void
     */
    public static function removeInstance()
    {
        $className = static::getClassName();
        if (isset(self::$instances[$className])) {
            unset(self::$instances[$className]);
        }
    }

    /**
     * Returns singleton's name
     *
     * @return string
     */
    final protected static function getClassName()
    {
        return get_called_class();
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
    final protected function __clone()
    {
    }

    /**
     * Serialization is disabled
     */
    final protected function __sleep()
    {
    }

    /**
     * Unserialization is disabled
     */
    final protected function __wakeup()
    {
    }
}

/**
 * Multiton abstract class
 *
 * @package Patterns
 */
abstract class Factory extends FactoryAbstract
{

    /**
     * Returns singleton
     *
     * @return static
     */
    final public static function getInstance()
    {
        return parent::getInstance();
    }

    /**
     * Removes singleton
     *
     * @return void
     */
    final public static function removeInstance()
    {
        parent::removeInstance();
    }
}

/*
 * =====================================
 *           USING OF MULTITON
 * =====================================
 */

/**
 * First singleton
 */
class FirstProduct extends Factory
{
    public $a = [];
}

/**
 * Second singleton
 */
class SecondProduct extends FirstProduct
{
}

// Filling property of singletons
FirstProduct::getInstance()->a[] = 1;
SecondProduct::getInstance()->a[] = 2;
FirstProduct::getInstance()->a[] = 3;
SecondProduct::getInstance()->a[] = 4;

print_r(FirstProduct::getInstance()->a);
// array(1, 3)
print_r(SecondProduct::getInstance()->a);
// array(2, 4)
