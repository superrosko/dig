<?php

namespace Superrosko\Dig\Exception;

use Throwable;

/**
 * Class DigFailGetRecordsException
 * @package Superrosko\Dig\Exception
 */
class DigFailGetRecordsException extends DigException
{
    /**
     * Fail when try get records.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     * @return static
     */
    public static function create(string $message = '', $code = 0, Throwable $previous = null)
    {
        return new static($message, $code, $previous);
    }
}