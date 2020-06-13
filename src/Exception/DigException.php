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
     * Custom resolver not support.
     *
     * @param Throwable|null $previous
     * @return static
     */
    public static function invalidResolver(Throwable $previous = null)
    {
        return new static('Custom resolver not support for this executor', 1, $previous);
    }
}
