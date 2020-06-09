<?php

namespace Superrosko\Dig\CacheEntities;

use DateTime;
use Superrosko\Dig\Exception\DigCacheInvalidArgumentException;
use Traversable;

/**
 * Class CacheStatic
 * @package Superrosko\Dig\CacheEntities
 */
class CacheStatic extends AbstractCacheEntities
{
    /**
     * Static cache variable
     *
     * @var array $cache {
     * @option int 'created_at'
     * @option int|null 'ttl'
     * @option mixed 'value'
     * }
     */
    private static $cache = [];

    /**
     * @inheritDoc
     */
    public function get($key, $default = null)
    {
        if (self::has($key)) {
            $cache = self::$cache[$key] ?? [];
            $ttl = $cache['ttl'] ?? null;
            if (is_null($ttl)) {
                return $cache['value'] ?? $default;
            } else {
                $now = (new DateTime())->getTimestamp();
                $createdAt = $cache['created_at'] ?? $now;
                if ($now <= $createdAt + $ttl) {
                    return $cache['value'] ?? $default;
                }
            }
        }
        return $default;
    }

    /**
     * @inheritDoc
     */
    public function set($key, $value, $ttl = null)
    {
        $createdAt = (new DateTime())->getTimestamp();
        self::$cache[$key] = [
            'value' => $value,
            'ttl' => $ttl,
            'created_at' => $createdAt,
        ];
        return true;
    }

    /**
     * @inheritDoc
     */
    public function delete($key)
    {
        if (self::has($key)) {
            unset(self::$cache[$key]);
            return true;
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function clear()
    {
        self::$cache = [];
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getMultiple($keys, $default = null)
    {
        if (!is_array($keys) && !$keys instanceof Traversable) {
            throw DigCacheInvalidArgumentException::invalidCacheKeys();
        }

        $values = [];
        foreach ($keys as $key) {
            $values[$key] = self::get($key, $default);
        }

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function setMultiple($values, $ttl = null)
    {
        if (!is_array($values) && !$values instanceof Traversable) {
            throw DigCacheInvalidArgumentException::invalidCacheValues();
        }

        foreach ($values as $key => $value) {
            self::set($key, $value, $ttl);
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteMultiple($keys)
    {
        if (!is_array($keys) && !$keys instanceof Traversable) {
            throw DigCacheInvalidArgumentException::invalidCacheKeys();
        }

        $noError = true;
        foreach ($keys as $key) {
            if (!self::delete($key)) {
                $noError = false;
            }
        }
        return $noError;
    }

    /**
     * @inheritDoc
     */
    public function has($key)
    {
        return isset(self::$cache[$key]);
    }
}
