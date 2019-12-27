<?php

namespace Superrosko\Dig\Exception;

use Exception;
use Throwable;

/**
 * Class DigException
 * @package Superrosko\Dig\Exceptions
 */
class DigException extends Exception
{
    /**
     * Cache not support.
     *
     * @param Throwable|null $previous
     * @return static
     */
    public static function invalidCache(Throwable $previous = null)
    {
        return new static('Cache not support for this executor', 1, $previous);
    }

    /**
     * Custom resolver not support.
     *
     * @param Throwable|null $previous
     * @return static
     */
    public static function invalidResolver(Throwable $previous = null)
    {
        return new static('Custom resolver not support for this executor', 2, $previous);
    }

    /**
     * Fail when try get records.
     *
     * @param string $message
     * @param Throwable|null $previous
     * @return static
     */
    public static function failGetRecords(string $message = '', Throwable $previous = null)
    {
        return new static('Fail when try get records (' . $message . ')', 3, $previous);
    }
}