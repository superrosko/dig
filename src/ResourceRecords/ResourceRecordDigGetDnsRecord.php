<?php

namespace Superrosko\Dig\ResourceRecords;

class ResourceRecordDigGetDnsRecord extends AbstractResourceRecord
{
    use TraitResourceRecord;

    const PROP_HOST = 'host'; // Index of host value in resource record array
    const PROP_CLASS = 'class'; // Index of class value in resource record array
    const PROP_TTL = 'ttl'; // Index of ttl value in resource record array
    const PROP_TYPE = 'type'; // Index of type value in resource record array

    /**
     * @var string - key with main data value in resource record array
     */
    private $dataKey = '';

    /**
     * @inheritDoc
     */
    public function getRequest()
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'raw' => $this->opt['raw'] ?? false,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getNS($record, bool $resolve = false)
    {
        $this->dataKey = 'target';
        return $this->getCommon($record, $resolve);
    }

    /**
     * @inheritDoc
     */
    public function getA($record, bool $resolve = false)
    {
        $this->dataKey = 'ip';
        return $this->getCommon($record, $resolve);
    }

    /**
     * @inheritDoc
     */
    public function getAAAA($record, bool $resolve = false)
    {
        $this->dataKey = 'ipv6';
        return $this->getCommon($record, $resolve);
    }

    /**
     * @inheritDoc
     */
    public function getTXT($record, bool $resolve = false)
    {
        $this->dataKey = 'txt';
        return $this->getCommon($record, $resolve);
    }

    /**
     * @inheritDoc
     */
    public function getCNAME($record, bool $resolve = false)
    {
        $this->dataKey = 'target';
        return $this->getCommon($record, $resolve);
    }

    /**
     * @param $record
     * @param bool $resolve
     * @return Record|null
     */
    public function getCommon($record, bool $resolve = false)
    {
        if ($recordProps = $this->parseRecord($record)) {
            $this->resolveIp($recordProps[$this->dataKey] ?? '', $resolve);
            return new Record(
                $recordProps[self::PROP_HOST],
                $recordProps[self::PROP_CLASS],
                $recordProps[self::PROP_TTL],
                $recordProps[self::PROP_TYPE],
                $recordProps[$this->dataKey],
                $this->opt
            );
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getRecordProps($record)
    {
        return $record;
    }
}