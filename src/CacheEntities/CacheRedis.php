<?php

namespace Superrosko\Dig\CacheEntities;

use \Exception;
use \Redis;

/**
 * Class CacheRedis
 * @package Superrosko\Dig\CacheEntities
 */
class CacheRedis extends AbstractCacheEntities
{
    /**
     * @var Redis $redis
     */
    private static $redis = null;

    /**
     * @inheritDoc
     */
    public function get(string $key)
    {
        if (self::$redis instanceof Redis) {
            $value = self::$redis->get($key) ?: null;
            return unserialize($value) ?: null;
        } else {
            throw new Exception('Redis object not found');
        }
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, $value)
    {
        if (self::$redis instanceof Redis) {
            self::$redis->set($key, serialize($value));
        } else {
            throw new Exception('Redis object not found');
        }
    }

    /**
     * Set Redis object
     *
     * @param Redis $redis
     */
    public function setRedis(Redis $redis)
    {
        self::$redis = $redis;
    }
}