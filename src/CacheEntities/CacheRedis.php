<?php

namespace Superrosko\Dig\CacheEntities;

use \Exception;
use \Redis;
use Superrosko\Dig\ResourceRecords\Record;

/**
 * Class CacheRedis
 * @package Superrosko\Dig\CacheEntities
 */
class CacheRedis extends AbstractCacheEntities
{
    /**
     * @var Redis $redis
     */
    protected static $redis = null;

    /**
     * @inheritDoc
     */
    public function get(string $key)
    {
        if (self::$redis instanceof Redis) {
            if ($value = self::$redis->hGetAll($key)) {
                $records = [];
                $ttl = self::$redis->ttl($key);
                foreach ($value as $data => $target_ip) {
                    $records[] = new Record($key, '', $ttl, 'NS', $data, ['target_ip' => $target_ip]);
                }
                return $records;
            }
            return null;
        } else {
            throw new Exception('Redis object not found');
        }
    }

    /**
     * @inheritDoc
     * @var Record $record
     */
    public function set(string $key, $value)
    {
        if (self::$redis instanceof Redis) {
            $ttl = [];
            $data = [];
            foreach ($value as $record) {
                $ttl[] = $record->ttl;
                $data[$record->data] = $record->opt['target_ip'];
            }
            self::$redis->hMSet($key, $data);
            self::$redis->expire($key, min($ttl));
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