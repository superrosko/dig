<?php

namespace Superrosko\Dig\CacheEntities;

/**
 * Class CacheStatic
 * @package Superrosko\Dig\CacheEntities
 */
class CacheStatic extends AbstractCacheEntities
{
    /**
     * Static cache variable
     *
     * @var array
     */
    private static $cache = [];

    /**
     * @inheritDoc
     */
    public function get(string $key)
    {
        return self::$cache[$key] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, $value)
    {
        self::$cache[$key] = $value;
    }
}