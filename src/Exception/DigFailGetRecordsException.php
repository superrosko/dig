<?php

namespace Superrosko\Dig\Exception;

use Throwable;

/**
 * Class DigFailGetRecords
 * @package Superrosko\Dig\Exception
 */
class DigFailGetRecordsException extends DigException
{
    /**
     * Fail when try get records.
     *
     * @param string $message
     * @param Throwable|null $previous
     * @return static
     */
    public static function create(string $message = '', Throwable $previous = null)
    {
        return new static('Fail when try get records (' . $message . ')', 3, $previous);
    }
}