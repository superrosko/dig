<?php

namespace Superrosko\Dig;

use Psr\SimpleCache\CacheInterface;
use \ReflectionException;
use Superrosko\Dig\Executor\ExecutorInterface;

/**
 * Class DigClient
 * @package Superrosko\Dig
 */
class DigClient
{
    /**
     * Constants with name of dig executors
     */
    const EXECUTOR_COMMAND = 'Command';
    const EXECUTOR_GET_DNS_RECORD = 'GetDnsRecord';

    /**
     * Create Dig executor object
     *
     * @param string $type
     * @param CacheInterface|null $cache
     * @return ExecutorInterface
     * @throws ReflectionException
     */
    public static function getExecutor(string $type, $cache = null)
    {
        $executor = 'Superrosko\Dig\Executor\ExecutorDig' . ucfirst($type);
        if (!class_exists($executor)) {
            throw new ReflectionException('Class ' . $executor . 'does not exist');
        }

        return new $executor($cache);
    }
}
