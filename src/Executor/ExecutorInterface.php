<?php

namespace Superrosko\Dig\Executor;

use \Exception;
use \ReflectionException;
use Superrosko\Dig\CacheEntities\CacheEntitiesInterface;
use Superrosko\Dig\Exception\DigException;
use Superrosko\Dig\ResourceRecords\Record;

/**
 * Interface ExecutorInterface
 * @package Superrosko\Dig\Executor
 */
interface ExecutorInterface
{
    /**
     * Return requested resource records from DNS servers
     *
     * @param string $name - domain name
     * @param int $type - resource record type from https://php.net/manual/en/network.constants.php
     * @param string|null $server - resolve server
     * @param array $opt - options
     * @param bool $resolve - resolve or not IP for response name records
     * @return array - array with resource records from response
     * @throws DigException
     * @throws ReflectionException
     */
    public function getRecords(string $name, int $type, string $server = null, array $opt = [], bool $resolve = false): array;

    /**
     * Method for executing request to DNS servers
     *
     * @param $request - request to DNS servers
     * @return mixed - response from DNS servers
     * @throws DigException
     */
    public function execute($request);

    /**
     * Set up cache storage for dig responses
     *
     * @param CacheEntitiesInterface|null $cache - object with cache storage
     * @throws DigException
     */
    public function setCache(CacheEntitiesInterface $cache = null);

    /**
     * Set up default resolver for dig
     *
     * @param string $resolver - string with resolver IP or name
     * @throws DigException
     */
    public function setDefaultResolver(string $resolver);

    /**
     * Return random record from records array
     *
     * @param array $records - array with resource records
     * @return Record|null
     */
    public static function getRandomRecord(array $records);

    /**
     * @param array $records
     * @return mixed|Record
     */
    public static function getRandomResolvedRecord(array $records);
    
    /**
     * Chunk domain name by zones
     *
     * @param string $name - domain name
     * @return array
     */
    public static function chunkNameByZones(string $name);

    /**
     * Recursive retrieve zones root servers, can use cache for zones root servers
     *
     * @param string $name - domain name
     * @param string|null $server - start resolver
     * @param array $opt - additional options
     * @param bool $resolve - resolve or not IP for response name records
     * @return array - array with resource records
     * @throws DigException
     * @throws Exception
     */
    public function getRootServers(string $name, string $server = null, array $opt = [], bool $resolve = false): array;
}