<?php

namespace Superrosko\Dig\CacheEntities;

use \Exception;

/**
 * Class AbstractCacheEntities
 * @package Superrosko\Dig\CacheEntities
 */
abstract class AbstractCacheEntities implements CacheEntitiesInterface
{
    /**
     * Array with cache instances
     *
     * @var AbstractCacheEntities[]
     */
    private static $instances = [];

    /**
     * AbstractCacheEntities constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Disabling cloning
     */
    protected function __clone()
    {
    }

    /**
     * Disabling recovery from serialized data
     *
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    /**
     * Save and return an instance of an object
     *
     * @return AbstractCacheEntities
     */
    public static function getInstance(): AbstractCacheEntities
    {
        $subclass = static::class;
        if (!isset(self::$instances[$subclass])) {
            self::$instances[$subclass] = new static;
        }

        return self::$instances[$subclass];
    }
}