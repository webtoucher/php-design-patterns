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

/**
 * Multiton abstract class
 *
 * @package Patterns
 */
abstract class RegistryFactory extends FactoryAbstract
{

    /**
     * Returns singleton by ID
     *
     * @param integer|string $id - singleton's ID
     * @return static
     */
    final public static function getInstance($id)
    {
        $className = static::getClassName();
        if (isset(self::$instances[$className])) {
            if (!isset(self::$instances[$className][$id])) {
                self::$instances[$className][$id] = new $className($id);
            }
        } else {
            self::$instances[$className] = [
                $id => new $className($id),
            ];
        }
        return self::$instances[$className][$id];
    }

    /**
     * Removes singleton by ID
     *
     * @param integer|string $id - singleton's ID. All class instances will be removed if ID is not set
     * @return void
     */
    final public static function removeInstance($id = null)
    {
        $className = static::getClassName();
        if (isset(self::$instances[$className])) {
            if (is_null($id)) {
                unset(self::$instances[$className]);
            } else {
                if (isset(self::$instances[$className][$id])) {
                    unset(self::$instances[$className][$id]);
                }
                if (empty(self::$instances[$className])) {
                    unset(self::$instances[$className]);
                }
            }
        }
    }

    protected function __construct($id)
    {
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
