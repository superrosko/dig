<?php

namespace Superrosko\Dig\ResourceRecords;

use \ReflectionException;

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
        if (method_exists(self::class, $method)) {
            foreach ($response as $record) {
                if ($recordProps = $this->$method($record, $resolve)) {
                    $recordsArray[] = $recordProps;
                }
            }
        } else {
            throw new ReflectionException('Method ' . $method . ' does not exist');
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