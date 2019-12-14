<?php

namespace Superrosko\Dig\ResourceRecords;

/**
 * Interface ResourceRecordsTypesInterface
 * @package Superrosko\Dig\ResourceRecords
 */
interface ResourceRecordsTypesInterface
{
    /**
     * Parse NS resource records response
     *
     * @param $record
     * @param bool $resolve
     * @return Record|null
     */
    public function getNS($record, bool $resolve = false);
}