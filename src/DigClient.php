<?php

namespace Superrosko\Dig;

use \ReflectionClass;
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
     * @param $type
     * @return ExecutorInterface
     * @throws ReflectionException
     */
    public static function getExecutor($type)
    {
        $executor = 'Superrosko\Dig\Executor\ExecutorDig' . ucfirst($type);
        new ReflectionClass($executor);

        return new $executor;
    }
}