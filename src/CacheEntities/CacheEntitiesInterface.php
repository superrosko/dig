<?php

namespace Superrosko\Dig\CacheEntities;

use \Exception;

/**
 * Interface CacheEntitiesInterface
 * @package Superrosko\Dig\CacheEntities
 */
interface CacheEntitiesInterface
{
    /**
     * @param string $key
     * @return bool|mixed|string|null
     * @throws Exception
     */
    public function get(string $key);

    /**
     * @param string $key
     * @param $value
     * @throws Exception
     */
    public function set(string $key, $value);
}