<?php

namespace Superrosko\Dig\Exception;

use Throwable;
use Psr\SimpleCache\InvalidArgumentException;

/**
 * Class CacheInvalidArgumentException
 * @package Superrosko\Dig\Exception
 */
class DigCacheInvalidArgumentException extends DigException implements InvalidArgumentException
{
    /**
     * Cache keys is neither an array nor a Traversable.
     *
     * @param Throwable|null $previous
     * @return static
     */
    public static function invalidCacheKeys(Throwable $previous = null)
    {
        return new static('Keys is neither an array nor a Traversable', 1, $previous);
    }

    /**
     * Cache values is neither an array nor a Traversable.
     *
     * @param Throwable|null $previous
     * @return static
     */
    public static function invalidCacheValues(Throwable $previous = null)
    {
        return new static('Values is neither an array nor a Traversable', 1, $previous);
    }
}
