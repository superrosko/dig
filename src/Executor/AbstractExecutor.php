<?php

namespace Superrosko\Dig\Executor;

use Superrosko\Dig\CacheEntities\CacheEntitiesInterface;
use Superrosko\Dig\Exception\DigException;
use Superrosko\Dig\ResourceRecords\AbstractResourceRecord;
use Superrosko\Dig\ResourceRecords\Record;

/**
 * Class AbstractExecutor
 * @package Superrosko\Dig\Executor
 */
abstract class AbstractExecutor implements ExecutorInterface
{
    /**
     * Cache storage for dig responses
     *
     * @var CacheEntitiesInterface $cache
     */
    protected $cache = null;

    /**
     * Default is Google Public DNS
     *
     * @var string
     */
    protected $resolver = '8.8.8.8';

    /**
     * Executor can't  use cache storage by default
     *
     * @inheritDoc
     */
    public function setCache(CacheEntitiesInterface $cache = null)
    {
        throw DigException::invalidCache();
    }

    /**
     * Executor can't  use custom resolver by default
     *
     * @inheritDoc
     */
    public function setDefaultResolver(string $resolver)
    {
        throw DigException::invalidResolver();
    }

    /**
     * @inheritDoc
     */
    public static function getRandomRecord(array $records)
    {
        $record = null;
        if (count($records)) {
            /**
             * @var Record $record
             */
            $record = $records[array_rand($records)];
        }
        return $record;
    }

    /**
     * @inheritDoc
     */
    public static function chunkNameByZones(string $name)
    {
        $zonesFull = ['.'];
        $zonesCurrent = '';
        $zones = array_reverse(explode('.', $name));
        foreach ($zones as $zone) {
            $zonesCurrent = $zone . '.' . $zonesCurrent;
            $zonesFull[] = $zonesCurrent;
        }

        return $zonesFull;
    }

    /**
     * @inheritDoc
     */
    public function getRootServers(string $name, string $server = null, array $opt = [], bool $resolve = false): array
    {
        $server = $server ?? $this->resolver;
        $chunkedDomain = self::chunkNameByZones($name);

        $count = count($chunkedDomain) - 1;
        for ($i = 0; $i < $count; $i++) {
            $records = null;
            if ($this->cache instanceof CacheEntitiesInterface) {
                $time = microtime(true);
                $records = $this->cache->get($chunkedDomain[$i]);
                echo 'Cache get time: ' . (microtime(true) - $time) . PHP_EOL;
            }

            if (is_null($records)) {
                $records = $this->getRecords($chunkedDomain[$i], DNS_NS, $server, [], true);
                if ($this->cache instanceof CacheEntitiesInterface) {
                    $time = microtime(true);
                    $this->cache->set($chunkedDomain[$i], $records);
                    echo 'Cache set time: ' . (microtime(true) - $time) . PHP_EOL;
                }
            }
            
            $record = self::getRandomRecord($records);
            $server = AbstractResourceRecord::getServer($record);
        }

        return $this->getRecords($chunkedDomain[$i], DNS_NS, $server, [], true);
    }
}