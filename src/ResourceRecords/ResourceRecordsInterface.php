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
     * @param $recordProp
     * @param bool $resolve
     */
    public function resolveIp($recordProp, bool $resolve);

    /**
     * @param $recordProp
     * @return bool
     */
    public function checkRecordType($recordProp);

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

    /**
     * Parse resource record by conditions
     *
     * @param $record
     * @return array|null
     */
    public function parseRecord($record);

    /**
     * Parse resource record by properties
     *
     * @param $record
     * @return array
     */
    public function getRecordProps($record);
}