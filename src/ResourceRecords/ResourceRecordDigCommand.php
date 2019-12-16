<?php

namespace Superrosko\Dig\ResourceRecords;

/**
 * Class ResourceRecordDigCommand
 * @package Superrosko\Dig\ResourceRecords
 */
class ResourceRecordDigCommand extends AbstractResourceRecord
{
    use TraitResourceRecord;

    const PROP_HOST = 0; // Index of host value in resource record array
    const PROP_CLASS = 2; // Index of class value in resource record array
    const PROP_TTL = 1; // Index of ttl value in resource record array
    const PROP_TYPE = 3; // Index of type value in resource record array
    const PROP_DATA = 4; // Index of data value in resource record array

    /**
     * @var array
     */
    protected $opt = [];

    /**
     * @inheritDoc
     */
    public function getRequest()
    {
        $type = $this->convertType();
        $name = idn_to_ascii($this->name) ?: $this->name;
        $opt = implode(' ', $this->opt) ?: '+noall +answer +authority +additional';

        return escapeshellcmd('dig ' . $type . ' ' . $opt . ' ' . $name . ' @' . $this->server);
    }

    /**
     * @inheritDoc
     */
    public function getNS($record, bool $resolve = false)
    {
        return $this->getCommon($record, $resolve);
    }

    /**
     * @inheritDoc
     */
    public function getA($record, bool $resolve = false)
    {
        return $this->getCommon($record, $resolve);
    }

    /**
     * @inheritDoc
     */
    public function getTXT($record, bool $resolve = false)
    {
        return $this->getCommon($record, $resolve);
    }

    /**
     * @inheritDoc
     */
    public function getCNAME($record, bool $resolve = false)
    {
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
            $this->resolveIp($recordProps[self::PROP_DATA] ?? '', $resolve);
            $data = implode(' ', array_slice($recordProps, self::PROP_DATA, count($recordProps)));
            return new Record(
                trim($recordProps[self::PROP_HOST] ?? '', '\.'),
                $recordProps[self::PROP_CLASS] ?? '',
                $recordProps[self::PROP_TTL] ?? '',
                $recordProps[self::PROP_TYPE] ?? '',
                trim($data, '\.'),
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
        return explode(' ', preg_replace('!\s+!', ' ', $record));
    }
}