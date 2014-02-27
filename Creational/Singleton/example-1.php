<?php
/**
 * Simple singleton class
 */
class Singleton
{

    private static $instance;

    public $a;

    /**
     * Returns singleton
     *
     * @return Singleton
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

$firstObject = Singleton::getInstance();
$secondObject = Singleton::getInstance();

$firstObject->a = 1;
$secondObject->a = 2;

print_r($firstObject->a);
// 2
print_r($secondObject->a);
// 2
