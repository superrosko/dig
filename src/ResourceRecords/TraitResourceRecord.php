<?php

namespace Superrosko\Dig\ResourceRecords;

use \ReflectionClass;

/**
 * Trait TraitResourceRecord
 * @package Superrosko\Dig\ResourceRecords
 */
trait TraitResourceRecord
{
    /**
     * @inheritDoc
     */
    public function parseResponse(array $response, bool $resolve = false)
    {
        $recordsArray = [];
        $method = 'get' . $this->convertType();
        if ((new ReflectionClass(self::class))->hasMethod($method)) {
            foreach ($response as $record) {
                if ($recordProps = $this->$method($record, $resolve)) {
                    $recordsArray[] = $recordProps;
                }
            }
        }

        return $recordsArray;
    }

    /**
     * @inheritDoc
     */
    public function convertType()
    {
        $types = [
            DNS_NS => 'NS',
            DNS_TXT => 'TXT',
        ];

        return $types[($this->type)] ?? null;
    }
}