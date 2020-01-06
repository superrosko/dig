<?php

namespace DigExamples\CacheEntities;

use \Exception;
use \Redis;
use Superrosko\Dig\CacheEntities\CacheEntitiesInterface;
use Superrosko\Dig\ResourceRecords\Record;

/**
 * Class CacheRedisDI
 * @package DigExamples\CacheEntities
 */
class CacheRedisDI implements CacheEntitiesInterface
{
    /**
     * @var Redis $redis
     */
    protected $redis = null;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }
    
    /**
     * @inheritDoc
     */
    public function get(string $key)
    {
        if ($this->redis instanceof Redis) {
            if ($value = $this->redis->hGetAll($key)) {
                $records = [];
                $ttl = $this->redis->ttl($key);
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
        if ($this->redis instanceof Redis) {
            $ttl = [];
            $data = [];
            foreach ($value as $record) {
                $ttl[] = $record->ttl;
                $data[$record->data] = $record->opt['target_ip'];
            }
            $this->redis->hMSet($key, $data);
            $this->redis->expire($key, min($ttl));
        } else {
            throw new Exception('Redis object not found');
        }
    }
}