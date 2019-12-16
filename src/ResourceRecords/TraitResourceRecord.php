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
    public function parseRecord($record)
    {
        $recordProps = $this->getRecordProps($record);
        if (count($recordProps) < self::MIN_PROPS_COUNT) {
            return null;
        }
        if (!$this->checkRecordType($recordProps[self::PROP_TYPE] ?? '')) {
            return null;
        }

        return $recordProps;
    }

    /**
     * @inheritDoc
     */
    public function convertType()
    {
        $types = [
            DNS_NS => 'NS',
            DNS_A => 'A',
            DNS_AAAA => 'AAAA',
            DNS_CNAME => 'CNAME',
            DNS_TXT => 'TXT',
        ];

        return $types[$this->type] ?? null;
    }
}