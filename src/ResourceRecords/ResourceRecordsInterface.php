<?php

namespace Superrosko\Dig\ResourceRecords;

use \ReflectionException;

interface ResourceRecordsInterface
{
    /**
     * Return resolved server IP or name if exists
     * 
     * @param Record $record
     * @return mixed
     */
    public static function getServer(Record $record);

    /**
     * Return request for different dig executors
     * 
     * @return mixed
     */
    public function getRequest();
    
    /**
     * Parse retrieved response
     * 
     * @param array $response
     * @param bool $resolve
     * @return array
     * @throws ReflectionException
     */
    public function parseResponse(array $response, bool $resolve = false);

    /**
     * Convert resource record type from https://php.net/manual/en/network.constants.php to string
     * 
     * @return string|null
     */
    public function convertType();
}