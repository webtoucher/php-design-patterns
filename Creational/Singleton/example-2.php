<?php
/**
 * General singleton abstract class
 *
 * @package Patterns
 */
abstract class SingletonAbstract
{

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
    protected static function getClassName()
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

/**
 * Singleton abstract class
 *
 * @package Patterns
 */
abstract class Singleton extends SingletonAbstract
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
     */
    final public static function removeInstance()
    {
        parent::removeInstance();
    }
}

/**
 * Instance pool abstract class
 *
 * @package Patterns
 */
abstract class InstancePool extends SingletonAbstract
{

    /**
     * Returns singleton by ID
     *
     * @param $id - singleton's ID
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
     * @param $id - singleton's ID. All class instances will be removed if ID is not set
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

    protected function __construct($id) {}
}

/*
 * =====================================
 *           USING OF SINGLETON
 * =====================================
 */

/**
 * First singleton
 */
class SingletonTest1 extends Singleton
{
    public $a = [];
}

/**
 * Second singleton
 */
class SingletonTest2 extends SingletonTest1
{
}

// Filling arrays of singletons SingletonTest1 and SingletonTest2
SingletonTest1::getInstance()->a[] = 1;
SingletonTest2::getInstance()->a[] = 2;
SingletonTest1::getInstance()->a[] = 3;
SingletonTest2::getInstance()->a[] = 4;

print_r(SingletonTest1::getInstance()->a);
// array(1, 3)
print_r(SingletonTest2::getInstance()->a);
// array(2, 4)


/*
 * =====================================
 *         USING OF INSTANCE POOL
 * =====================================
 */

/**
 * First instance pool
 */
class InstancePoolTest1 extends InstancePool
{
    public $a = [];
}

/**
 * Second instance pool
 */
class InstancePoolTest2 extends InstancePoolTest1
{
}

// Параллельно обращаемся к синглтонам разных классов
InstancePoolTest1::getInstance(1)->a[] = 1;
InstancePoolTest1::getInstance(2)->a[] = 2;
InstancePoolTest2::getInstance(1)->a[] = 3;
InstancePoolTest2::getInstance(2)->a[] = 4;
InstancePoolTest1::getInstance(1)->a[] = 5;
InstancePoolTest1::getInstance(2)->a[] = 6;
InstancePoolTest2::getInstance(1)->a[] = 7;
InstancePoolTest2::getInstance(2)->a[] = 8;

print_r(InstancePoolTest1::getInstance(1)->a);
// array(1, 5)
print_r(InstancePoolTest1::getInstance(2)->a);
// array(2, 6)
print_r(InstancePoolTest2::getInstance(1)->a);
// array(3, 7)
print_r(InstancePoolTest2::getInstance(2)->a);
// array(4, 8)
